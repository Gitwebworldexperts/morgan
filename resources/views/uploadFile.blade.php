<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>
<body>
    <h1>Upload File</h1>
    <form id="fileForm" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" id="file" required>
        <button type="submit">Upload</button>
    </form>

    <div id="fileUrl"></div>

    <script>
        document.getElementById('fileForm').addEventListener('submit', function (event) {
            event.preventDefault();

            let formData = new FormData();
            formData.append('file', document.getElementById('file').files[0]);

            fetch('/files/upload', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('fileUrl').innerText = 'File URL: ' + data.file_url;
            })
            .catch(error => console.error('Error uploading file:', error));
        });
    </script>
</body>
</html>
