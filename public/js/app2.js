// untuk barang
// Definisi fungsi toggleCreateFormBarang
function toggleCreateFormBarang() {
    // Mengambil elemen dengan ID 'create-form-barang' dari dokumen HTML
    var createFormBarang = document.getElementById('create-form-barang');
    
    // Mengubah properti style.display dari elemen tersebut berdasarkan kondisi
    // Jika style.display saat ini adalah 'none' atau kosong, maka ubah menjadi 'block'
    // Jika tidak, ubah menjadi 'none'
    createFormBarang.style.display = (createFormBarang.style.display === 'none' ||
    createFormBarang.style.display === '') ? 'block' : 'none';
}
