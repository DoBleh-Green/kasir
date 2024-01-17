// untuk barang
function toggleCreateFormBarang() {
    var createFormBarang = document.getElementById('create-form-barang');
    createFormBarang.style.display = (createFormBarang.style.display === 'none' ||
    createFormBarang.style.display === '') ? 'block' : 'none';
}