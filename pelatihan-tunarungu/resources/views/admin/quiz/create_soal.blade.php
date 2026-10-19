@extends('admin.layout')

@section('title', 'Tambah Soal - Admin')

@section('content')
<div class="container-fluid px-0">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-2">Tambah Soal Baru</h2>
            <p class="text-muted mb-0">Untuk Kuis: <strong>{{ $quiz->judul }}</strong></p>
        </div>
        <a href="{{ route('admin.quiz.soal.index', $quiz->id) }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body p-4">
                    
                    <form action="{{ route('admin.quiz.soal.store', $quiz->id) }}" method="POST" id="form-batch">
                        @csrf
                        
                        <div id="soal-container">
                            <!-- TEMPLATE SOAL 1 -->
                            <div class="soal-item border rounded p-3 mb-3 bg-light position-relative">
                                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                                    <span class="fw-bold text-primary soal-number">SOAL 1</span>
                                    <button type="button" class="btn btn-sm btn-danger btn-remove-soal" style="display:none;">Hapus</button>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label fw-bold small">Pertanyaan <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="soal[0][pertanyaan]" rows="3" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold small">Pilihan Jawaban <span class="text-danger">*</span></label>
                                    <div class="row g-2">
                                        <div class="col-md-6 d-flex align-items-center gap-2">
                                            <span class="badge bg-primary">A</span>
                                            <input type="text" class="form-control" name="soal[0][opsi_a]" required>
                                        </div>
                                        <div class="col-md-6 d-flex align-items-center gap-2">
                                            <span class="badge bg-primary">B</span>
                                            <input type="text" class="form-control" name="soal[0][opsi_b]" required>
                                        </div>
                                        <div class="col-md-6 d-flex align-items-center gap-2">
                                            <span class="badge bg-primary">C</span>
                                            <input type="text" class="form-control" name="soal[0][opsi_c]" required>
                                        </div>
                                        <div class="col-md-6 d-flex align-items-center gap-2">
                                            <span class="badge bg-primary">D</span>
                                            <input type="text" class="form-control" name="soal[0][opsi_d]" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label class="form-label fw-bold small">Kunci Jawaban <span class="text-danger">*</span></label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="soal[0][kunci]" value="A" id="kunci_0_A" required>
                                            <label class="form-check-label" for="kunci_0_A">A</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="soal[0][kunci]" value="B" id="kunci_0_B">
                                            <label class="form-check-label" for="kunci_0_B">B</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="soal[0][kunci]" value="C" id="kunci_0_C">
                                            <label class="form-check-label" for="kunci_0_C">C</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="soal[0][kunci]" value="D" id="kunci_0_D">
                                            <label class="form-check-label" for="kunci_0_D">D</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-outline-primary w-100 mb-4 border-dashed" id="btn-tambah-soal">
                            <i class="fa-solid fa-plus me-1"></i> Tambah Form Soal Lagi
                        </button>

                        <div class="d-flex gap-2 pt-3 border-top">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Semua Soal
                            </button>
                            <a href="{{ route('admin.quiz.soal.index', $quiz->id) }}" class="btn btn-light px-4 border">Batal</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

{{-- SCRIPT DILETAKKAN LANGSUNG DI SINI AGAR PASTI TERBACA --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('soal-container');
    const btnTambah = document.getElementById('btn-tambah-soal');
    let soalIndex = 1; 

    btnTambah.addEventListener('click', function() {
        const newItem = document.createElement('div');
        newItem.className = 'soal-item border rounded p-3 mb-3 bg-light position-relative';
        
        newItem.innerHTML = `
            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                <span class="fw-bold text-primary soal-number">SOAL ${soalIndex + 1}</span>
                <button type="button" class="btn btn-sm btn-danger btn-remove-soal">Hapus</button>
            </div>
            
            <div class="mb-3">
                <label class="form-label fw-bold small">Pertanyaan <span class="text-danger">*</span></label>
                <textarea class="form-control" name="soal[${soalIndex}][pertanyaan]" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold small">Pilihan Jawaban <span class="text-danger">*</span></label>
                <div class="row g-2">
                    <div class="col-md-6 d-flex align-items-center gap-2">
                        <span class="badge bg-primary">A</span>
                        <input type="text" class="form-control" name="soal[${soalIndex}][opsi_a]" required>
                    </div>
                    <div class="col-md-6 d-flex align-items-center gap-2">
                        <span class="badge bg-primary">B</span>
                        <input type="text" class="form-control" name="soal[${soalIndex}][opsi_b]" required>
                    </div>
                    <div class="col-md-6 d-flex align-items-center gap-2">
                        <span class="badge bg-primary">C</span>
                        <input type="text" class="form-control" name="soal[${soalIndex}][opsi_c]" required>
                    </div>
                    <div class="col-md-6 d-flex align-items-center gap-2">
                        <span class="badge bg-primary">D</span>
                        <input type="text" class="form-control" name="soal[${soalIndex}][opsi_d]" required>
                    </div>
                </div>
            </div>

            <div class="mb-2">
                <label class="form-label fw-bold small">Kunci Jawaban <span class="text-danger">*</span></label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="soal[${soalIndex}][kunci]" value="A" id="kunci_${soalIndex}_A" required>
                        <label class="form-check-label" for="kunci_${soalIndex}_A">A</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="soal[${soalIndex}][kunci]" value="B" id="kunci_${soalIndex}_B">
                        <label class="form-check-label" for="kunci_${soalIndex}_B">B</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="soal[${soalIndex}][kunci]" value="C" id="kunci_${soalIndex}_C">
                        <label class="form-check-label" for="kunci_${soalIndex}_C">C</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="soal[${soalIndex}][kunci]" value="D" id="kunci_${soalIndex}_D">
                        <label class="form-check-label" for="kunci_${soalIndex}_D">D</label>
                    </div>
                </div>
            </div>
        `;

        container.appendChild(newItem);
        soalIndex++;
        updateRemoveButtons();
    });

    container.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-remove-soal')) {
            const itemToRemove = e.target.closest('.soal-item');
            itemToRemove.remove();
            updateNomorSoal();
            updateRemoveButtons();
        }
    });

    function updateNomorSoal() {
        const items = container.querySelectorAll('.soal-item');
        items.forEach((item, index) => {
            item.querySelector('.soal-number').textContent = `SOAL ${index + 1}`;
        });
    }

    function updateRemoveButtons() {
        const items = container.querySelectorAll('.soal-item');
        items.forEach(item => {
            const btn = item.querySelector('.btn-remove-soal');
            btn.style.display = (items.length === 1) ? 'none' : 'inline-block';
        });
    }
});
</script>
@endsection