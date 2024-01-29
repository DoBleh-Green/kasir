// untuk kasir
// Definisi fungsi toggleCreateForm
function toggleCreateForm() {
    // Mengambil elemen dengan ID 'create-form' dari dokumen HTML
    var createForm = document.getElementById('create-form');
    
    // Mengubah properti style.display dari elemen tersebut berdasarkan kondisi
    // Jika style.display saat ini adalah 'none' atau kosong, maka ubah menjadi 'block'
    // Jika tidak, ubah menjadi 'none'
    createForm.style.display = (createForm.style.display === 'none' ||
    createForm.style.display === '') ? 'block' : 'none';
}
