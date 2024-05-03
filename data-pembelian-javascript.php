<script>
  daftar_barang = [];
  generate_daftar_barang();

  function tambahBarang() {
    // Mengambil nilai dari input berdasarkan attribut ID
    var select_produk = document.getElementById('produk_id');
    var produk_id = select_produk.value;
    var nama_produk = select_produk.selectedOptions[0].textContent;
    var harga_beli = document.getElementById('harga_beli').value;
    var jumlah = document.getElementById('jumlah').value;

    // Cek masing-masing input harus diisi
    if (produk_id == '' || harga_beli == '' || jumlah == '') {
      alert('Silahkan isi data dengan lengkap');
      return false;
    }

    // Cek apakah data barang sudah ada di dalam array daftar_barang, jika sudah ada maka edit data, jika belum maka tambahkan data
    for (const barang of daftar_barang) {
      if (barang.produk_id == produk_id) {
        barang.harga_beli = harga_beli;
        barang.jumlah = jumlah;
        generate_daftar_barang();
        return false;
      }
    }
    // menambah data barang ke dalam array daftar_barang
    var data = {
      produk_id: produk_id,
      nama_produk: nama_produk,
      harga_beli: harga_beli,
      jumlah: jumlah
    };
    daftar_barang.push(data);

    // Mengosongkan input
    document.getElementById('harga_beli').value = '';
    document.getElementById('produk_id').value = '';
    document.getElementById('jumlah').value = '';

    // generate daftar barang
    generate_daftar_barang();
  }

  function generate_daftar_barang() {
    var html = "";
    var total = 0;
    if (daftar_barang.length == 0) {
      html += `<tr>`;
      html += `<td colspan='6' class='text-center'><em>Data Kosong</em></td>`;
      html += `</tr>`;
    } else {
      var no = 1;
      var index = 0;
      for (const barang of daftar_barang) {
        var subtotal = barang.harga_beli * barang.jumlah;
        total += subtotal;
        html += `<input type="hidden" name="produk_id[]" value="${barang.produk_id}">`;
        html += `<input type="hidden" name="harga_beli[]" value="${barang.harga_beli}">`;
        html += `<input type="hidden" name="jumlah[]" value="${barang.jumlah}">`;
        html += `<tr>`;
        html += `<td>${no}</td>`;
        html += `<td>${barang.nama_produk}</td>`;
        html += `<td>${formatRupiah(barang.harga_beli)}</td>`;
        html += `<td>${barang.jumlah}</td>`;
        html += `<td class="text-end">${formatRupiah(subtotal)}</td>`;
        html += `<td class="text-center"><button type="button" onclick="hapusBarang(${index})" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></td>`;
        html += `</tr>`;
        no++;
        index++;
      }
      document.getElementById('total').innerHTML = formatRupiah(total);
    }
    document.getElementById('daftar_barang').innerHTML = html;
  }

  function hapusBarang(index) {
    daftar_barang.splice(index, 1);
    generate_daftar_barang();
  }
</script>