# app.py
import os
import json
from fastapi import FastAPI, HTTPException
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel
from dotenv import load_dotenv
import google.genai as genai

# 1. Load environment variable (.env)
load_dotenv()
API_KEY = os.getenv("GEMINI_API_KEY")
MODEL = os.getenv("GEMINI_MODEL", "gemini-1.5-flash")

if not API_KEY:
    raise RuntimeError("GEMINI_API_KEY tidak ditemukan di .env")

# 2. Setup Gemini client
client = genai.Client(api_key=API_KEY)

# 3. Setup FastAPI app
app = FastAPI()

# Aktifkan CORS (biar Laravel bisa akses)
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],  # production sebaiknya ganti ke domain Laravel
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# 4. Definisikan request schema
class AnalyzeRequest(BaseModel):
    student_id: int
    answers: list  # contoh: [{"q":1,"correct":False}, {"q":2,"correct":True}]

# 5. Endpoint tes (buat cek server jalan)
@app.get("/")
def root():
    return {"message": "AI microservice is running 🚀"}

# 6. Endpoint analisis + rekomendasi soal
@app.post("/analyze")
async def analyze(data: AnalyzeRequest):
    try:
        # Hitung soal yang salah
        wrong = [a for a in data.answers if a["correct"] is False]
        weak_points = [f"Q{a['q']}" for a in wrong]

        # Buat prompt untuk Gemini
        prompt = f"""
        Seorang siswa (ID: {data.student_id}) salah di {len(wrong)} soal: {weak_points}.
        Tolong buat laporan singkat:
        1. Materi yang lemah
        2. Saran latihan tambahan
        3. Contoh soal baru (1 saja).
        """

        # Panggil Gemini
        response = client.models.generate_content(
            model=MODEL,
            contents=prompt
        )

        return {
            "student_id": data.student_id,
            "weak_points": weak_points,
            "ai_suggestion": response.text
        }

    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))
