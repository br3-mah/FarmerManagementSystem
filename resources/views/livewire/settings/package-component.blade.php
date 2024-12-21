
<div class="content-wrapper">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>

        .upload-container {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            width: 90%;
            max-width: 600px;
            transition: all 0.3s ease;
        }

        .upload-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #4a5568;
            font-size: 2rem;
            margin-bottom: 2rem;
            font-weight: 600;
        }

        .upload-area {
            border: 3px dashed #e2e8f0;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            margin-bottom: 1.5rem;
        }

        .upload-area:hover {
            border-color: #957f3e;
            background: #faf5ff;
        }

        .upload-icon {
            font-size: 3rem;
            color: #957f3e;
            margin-bottom: 1rem;
        }

        .file-label {
            font-size: 1.2rem;
            color: #4a5568;
            margin-bottom: 0.5rem;
            display: block;
        }

        .file-hint {
            color: #718096;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .file-input {
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .upload-btn {
            background: #957f3e;
            color: white;
            border: none;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            border-radius: 10px;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
        }

        .upload-btn:hover {
            background: #89690a;
            transform: translateY(-2px);
        }

        .upload-status {
            margin-top: 1rem;
            padding: 1rem;
            border-radius: 10px;
            display: none;
        }

        .status-success {
            background: #c6f6d5;
            color: #2f855a;
            display: block;
        }

        .status-error {
            background: #fed7d7;
            color: #c53030;
            display: block;
        }

        .selected-file {
            margin-top: 1rem;
            color: #957f3e;
            font-size: 0.9rem;
            display: none;
        }
    </style>
    <div class="upload-container">
        <h2>Upload Module Package</h2>
        <form id="zipUploadForm" enctype="multipart/form-data" method="POST" action="{{ route('upload-module') }}">
            @csrf
            <div class="upload-area">
                <i class="fas fa-cloud-upload-alt upload-icon"></i>
                <label class="file-label">Drop your ZIP file here</label>
                <p class="file-hint">or click to browse files</p>
                <input type="file" class="file-input" id="zipFile" name="zipFile" accept=".zip" required>
            </div>
            <div class="selected-file" id="selectedFile"></div>
            <button type="submit" class="upload-btn">
                <i class="fas fa-upload"></i> Upload File
            </button>
        </form>
        <div id="uploadStatus" class="upload-status"></div>
    </div>

    <script>
        const fileInput = document.getElementById('zipFile');
        const selectedFile = document.getElementById('selectedFile');
        const uploadArea = document.querySelector('.upload-area');

        fileInput.addEventListener('change', function() {
            if (this.files[0]) {
                selectedFile.style.display = 'block';
                selectedFile.textContent = `Selected: ${this.files[0].name}`;
            }
        });

        // Drag and drop functionality
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults (e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            uploadArea.style.borderColor = '#957f3e';
            uploadArea.style.background = '#faf5ff';
        }

        function unhighlight(e) {
            uploadArea.style.borderColor = '#e2e8f0';
            uploadArea.style.background = 'white';
        }

        uploadArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
            if (files[0]) {
                selectedFile.style.display = 'block';
                selectedFile.textContent = `Selected: ${files[0].name}`;
            }
        }

        document.getElementById('zipUploadForm').onsubmit = function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            const uploadStatus = document.getElementById('uploadStatus');
            const uploadBtn = document.querySelector('.upload-btn');

            uploadBtn.disabled = true;
            uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Uploading...';

            fetch('/upload-zip', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    uploadStatus.className = 'upload-status status-success';
                    uploadStatus.innerHTML = '<i class="fas fa-check-circle"></i> File uploaded successfully!';
                } else {
                    uploadStatus.className = 'upload-status status-error';
                    uploadStatus.innerHTML = '<i class="fas fa-exclamation-circle"></i> Error: ' + data.message;
                }
            })
            .catch(error => {
                uploadStatus.className = 'upload-status status-error';
                uploadStatus.innerHTML = '<i class="fas fa-exclamation-circle"></i> Error: ' + error.message;
            })
            .finally(() => {
                uploadBtn.disabled = false;
                uploadBtn.innerHTML = '<i class="fas fa-upload"></i> Upload File';
            });
        };
    </script>
</div>
