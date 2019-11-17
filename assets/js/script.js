var total;

function getRandom() { return Math.ceil(Math.random() * 10); }
function createSum() {
    var randomNum1 = getRandom(),
        randomNum2 = getRandom();
    total = randomNum1 + randomNum2;
    $("#question").text(randomNum1 + " + " + randomNum2);
    $("#question2").text(randomNum1 + " + " + randomNum2);
    $("#ans").val('');
    $("#ans2").val('');
    checkInput();
    checkInput2();
}

function checkInput() {
    var input = $("#ans").val(),
        slideSpeed = 200,
        hasInput = !!input,
        valid = hasInput && input == total;

    $('#message').toggle(!hasInput);
    $('#tombolHapus').prop('disabled', !valid);
    $('#success').toggle(valid);
    $('#fail').toggle(hasInput && !valid);
}
function checkInput2() {
    var input = $("#ans2").val(),
        slideSpeed = 200,
        hasInput = !!input,
        valid = hasInput && input == total;

    $('#message').toggle(!hasInput);
    $('#tombolHapusUser').prop('disabled', !valid);
    $('#success').toggle(valid);
    $('#fail').toggle(hasInput && !valid);
}

function loadUlang() {
    location.reload();
}

$(document).ready(function () {

    //create initial sum
    createSum();
    // On "reset button" click, generate new random sum
    $('button[type=reset]').click(createSum);
    // On user input, check value
    $("#ans").keyup(checkInput);
    $("#ans2").keyup(checkInput2);

    $('.tambahBuku').on('click', function () {
        $('#bookModalLabel').html('Tambah Buku');
        $('#submitButton').html('Submit');
        $('.modal-body form').attr('action', 'http://localhost/SPB/manage/addBook');
        $('#judul').val('');
        $('#penulis').val('');
        $('#tahun').val('');
        $('#penerbit').val('');
        $('#kota_terbit').val('');
        $('#sub_judul').val('');
        $('#jumlah_halaman').val('');
        $('#letak_buku').val('');
        $('#jumlah').val('');
        $('#id').val('');
    });

    $('.ubahBuku').on('click', function () {
        $('#bookModalLabel').html('Ubah Data Buku');
        $('#submitButton').html('Simpan Perubahan');
        $('.modal-body form').attr('action', 'http://localhost/SPB/manage/editBook');

        const id = $(this).data('id');
        //judul	penulis	tahun	penerbit	kota_terbit	sub_judul	jumlah_halaman	letak_buku	jumlah
        $.ajax({
            url: 'http://localhost/SPB/manage/getBookById',
            data: { id: id },
            method: 'POST',
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
                $('#judul').val(data.judul);
                $('#penulis').val(data.penulis);
                $('#tahun').val(data.tahun);
                $('#penerbit').val(data.penerbit);
                $('#kota_terbit').val(data.kota_terbit);
                $('#sub_judul').val(data.sub_judul);
                $('#jumlah_halaman').val(data.jumlah_halaman);
                $('#letak_buku').val(data.letak_buku);
                $('#jumlah').val(data.jumlah);
                $('#id').val(data.id);
            }
        })
    });

    $('.tombolHapusBuku').on('click', function () {
        const id = $(this).data('id');
        $('#tombolHapus').attr('data-id', id);
    });

    $('#tombolHapus').on('click', function () {
        const id = $(this).data('id');
        console.log(id);

        $.ajax({
            url: 'http://localhost/SPB/manage/deleteBook',
            data: { id: id },
            method: 'POST',
            dataType: "JSON",
            success: function () {
                alert('sukses menghapus data buku');
            },
            failure: function () {
                alert('gagal menghapus data buku');
            }
        });
    });

    $('.tambahUser').on('click', function () {
        $('#userModalLabel').html('Tambah User');
        $('#submitUserButton').html('Submit');
        $('.modal-body form').attr('action', 'http://localhost/SPB/manage/addUser');
        $('.passForm').show();
        $('#password1').prop('required', true);
        $('#password2').prop('required', true);
        $('#nama').val('');
        $('#username').val('');
        $('#id').val('');
    });

    $('.tombolHapusUser').on('click', function () {
        const id = $(this).data('id');
        $('#tombolHapusUser').attr('data-id', id);
    });

    $('#tombolHapusUser').on('click', function () {
        const id = $(this).data('id');
        console.log(id);

        $.ajax({
            url: 'http://localhost/SPB/manage/deleteUser',
            data: { id: id },
            method: 'POST',
            dataType: "JSON",
            success: function () {
                alert('sukses menghapus data buku');
                console.log('Success');
            },
            failure: function () {
                alert('gagal menghapus data buku');
                console.log('Failure');
            }
        });
    });

    $('.ubahUser').on('click', function () {
        $('#userModalLabel').html('Ubah Data User');
        $('#submitUserButton').html('Simpan Perubahan');
        $('.modal-body form').attr('action', 'http://localhost/SPB/manage/editUser');
        $('.passForm').hide();
        $('#password1').removeAttr('required');
        $('#password2').removeAttr('required');

        const id = $(this).data('id');
        //judul	penulis	tahun	penerbit	kota_terbit	sub_judul	jumlah_halaman	letak_buku	jumlah
        $.ajax({
            url: 'http://localhost/SPB/manage/getUserById',
            data: { id: id },
            method: 'POST',
            dataType: 'JSON',
            success: function (data) {
                $('#idUser').val(data.id);
                $('#nama').val(data.name);
                $('#username').val(data.username);
            }
        })
    });

});
