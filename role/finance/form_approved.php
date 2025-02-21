<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Dinamis</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script>
        // Fungsi untuk menambahkan input field
        function addInputField() {
            const inputFieldsContainer = document.getElementById('inputFieldsContainer');

            // Buat elemen input baru
            const newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'dynamicInput';
            newInput.classList.add('form-control', 'mb-2');
            newInput.placeholder = 'Masukkan teks';

            // Buat elemen button untuk menghapus input field
            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.classList.add('btn', 'btn-danger', 'btn-sm');
            removeButton.innerHTML = '&times;'; // Simbol "X"
            removeButton.onclick = function () {
                inputFieldsContainer.removeChild(inputGroup);
            };

            // Buat elemen div untuk mengelompokkan input dan tombol hapus
            const inputGroup = document.createElement('div');
            inputGroup.classList.add('input-group');

            // Tambahkan elemen input ke dalam input group
            inputGroup.appendChild(newInput);

            // Tambahkan elemen button ke dalam input group
            inputGroup.appendChild(removeButton);

            // Tambahkan elemen input group ke dalam container
            inputFieldsContainer.appendChild(inputGroup);
        }

        // Fungsi untuk membuka modal
        function openModal() {
            $('#dynamicFormModal').modal('show');
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            $('#dynamicFormModal').modal('hide');
        }
    </script>
</head>
<body>

    <div class="container mt-5">
        <div id="inputFieldsContainer">
            <!-- Container untuk menampung input field dinamis -->
        </div>

        <button class="btn btn-primary" onclick="addInputField()">Tambah Field</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
