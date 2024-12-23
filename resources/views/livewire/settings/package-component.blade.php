<div class="content-wrapper">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .content-wrapper {
            padding: 2rem;
            background: #f7fafc;
            font-family: Arial, sans-serif;
        }

        .upload-container {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .modules-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .module-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .module-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .module-card i {
            font-size: 2.5rem;
            color: #957f3e;
            margin-bottom: 1rem;
        }

        .module-card h3 {
            font-size: 1.2rem;
            color: #4a5568;
            margin-bottom: 1rem;
        }

        .module-card button {
            border: none;
            border-radius: 10px;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            margin: 0.3rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-activate {
            background: #38a169;
            color: white;
        }

        .btn-activate:hover {
            background: #2f855a;
        }

        .btn-deactivate {
            background: #e53e3e;
            color: white;
        }

        .btn-deactivate:hover {
            background: #c53030;
        }

        .btn-delete {
            background: #718096;
            color: white;
        }

        .btn-delete:hover {
            background: #4a5568;
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
            <button type="submit" class="upload-btn">
                <i class="fas fa-upload"></i> Upload File
            </button>
        </form>
    </div>

    <div class="modules-grid">
         @foreach($modules as $module)
       {{-- <div class="module-card">
            <i class="fas fa-puzzle-piece"></i>
            <h3>{{ $module->getName() }}</h3>
            <button class="btn-deactivate" onclick="deactivateModule('{{ $module->getName(); }}')">Deactivate</button>

            <button class="btn-activate" onclick="activateModule('{{ $module->getName(); }}')">Activate</button>


            <button class="btn-delete" onclick="deleteModule('{{ $module->getName(); }}')">Delete</button>
        </div>--}}
        @endforeach
    </div>

    <script>
        function deactivateModule(moduleName) {
            if (confirm(`Are you sure you want to deactivate the module: ${moduleName}?`)) {
                fetch(`/modules/deactivate/${moduleName}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(response => response.json())
                  .then(data => {
                      if (data.success) {
                          alert('Module deactivated successfully');
                          location.reload();
                      } else {
                          alert('Error deactivating module: ' + data.message);
                      }
                  });
            }
        }

        function activateModule(moduleName) {
            if (confirm(`Are you sure you want to activate the module: ${moduleName}?`)) {
                fetch(`/modules/activate/${moduleName}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(response => response.json())
                  .then(data => {
                      if (data.success) {
                          alert('Module activated successfully');
                          location.reload();
                      } else {
                          alert('Error activating module: ' + data.message);
                      }
                  });
            }
        }

        function deleteModule(moduleName) {
            if (confirm(`Are you sure you want to delete the module: ${moduleName}?`)) {
                fetch(`/modules/delete/${moduleName}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(response => response.json())
                  .then(data => {
                      if (data.success) {
                          alert('Module deleted successfully');
                          location.reload();
                      } else {
                          alert('Error deleting module: ' + data.message);
                      }
                  });
            }
        }
    </script>
</div>
