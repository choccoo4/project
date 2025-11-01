# app.py
import os
from typing import List
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

# 4. Definisikan schema untuk jawaban
class Answer(BaseModel):
    q: int
    question: str
    student_answer: str
    correct_answer: str
    correct: bool

class AnalyzeRequest(BaseModel):
    student_id: int
    answers: List[Answer]

# 5. Endpoint tes
@app.get("/")
def root():
    return {"message": "AI microservice is running 🚀"}

# 6. Endpoint analisis + rekomendasi soal
@app.post("/analyze")
async def analyze(data: AnalyzeRequest):
    try:
        # Ambil soal yang salah
        wrong = [a for a in data.answers if a.correct is False]
        weak_points = [f"Q{a.q}" for a in wrong]

        # Buat prompt untuk Gemini
        prompt = f"""
        Seorang siswa (ID: {data.student_id}) mengerjakan {len(data.answers)} soal.
        Ia salah pada {len(wrong)} soal: {weak_points}.

        Berikut detail soal yang salah:
        {[(a.q, a.question, a.student_answer, a.correct_answer) for a in wrong]}

        Tolong buat laporan singkat dalam bahasa yang mudah dipahami anak SD:
        1. Materi yang lemah
        2. Saran latihan tambahan
        3. Contoh soal baru (1 saja, sesuai level kelas 3–5 SD).
        """

        # Panggil Gemini API
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
