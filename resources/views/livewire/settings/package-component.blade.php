
<div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #367c4a;
            --primary-dark: #055c2f;
            --success: #22c55e;
            --danger: #ef4444;
            --warning: #f59e0b;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f9fafb;
            margin: 0;
            padding: 20px;
            line-height: 1.5;
        }

        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .upload-container {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            margin-bottom: 2rem;
        }

        .upload-container h2 {
            color: #1f2937;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .upload-area {
            border: 2px dashed #e5e7eb;
            border-radius: 12px;
            padding: 3rem 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            background: #f8fafc;
        }

        .upload-area:hover {
            border-color: var(--primary);
            background: #f1f5f9;
        }

        .upload-icon {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .file-label {
            font-size: 1.25rem;
            color: #4b5563;
            font-weight: 500;
            display: block;
            margin-bottom: 0.5rem;
        }

        .file-hint {
            color: #6b7280;
            margin: 0;
        }

        .file-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .upload-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            display: block;
            width: 100%;
            margin-top: 1.5rem;
        }

        .upload-btn:hover {
            background: var(--primary-dark);
        }

        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            padding: 2rem;
        }

        .modules-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .module-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid #e5e7eb;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .module-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px -4px rgb(0 0 0 / 0.1);
        }

        .module-card i {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .module-card h3 {
            color: #1f2937;
            margin: 0.5rem 0 1rem;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .btn-activate, .btn-deactivate, .btn-delete {
            width: 100%;
            padding: 0.625rem;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-bottom: 0.5rem;
        }

        .btn-activate {
            background: var(--success);
            color: white;
        }

        .btn-activate:hover {
            background: #16a34a;
        }

        .btn-deactivate {
            background: var(--warning);
            color: white;
        }

        .btn-deactivate:hover {
            background: #d97706;
        }

        .btn-delete {
            background: var(--danger);
            color: white;
        }

        .btn-delete:hover {
            background: #dc2626;
        }

        .alert {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            padding: 1rem 2rem;
            border-radius: 8px;
            animation: slideIn 0.3s ease-out;
            z-index: 1000;
        }

        .alert-success {
            background: var(--success);
            color: white;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .content-wrapper {
                padding: 1rem;
            }

            .modules-grid {
                grid-template-columns: 1fr;
            }

            .upload-area {
                padding: 2rem 1rem;
            }
        }
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            position: relative;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .close-modal {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }

        .upload-area {
            border: 2px dashed #ccc;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
        }

        .upload-btn {
            background: #4b915e;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .upload-btn:hover {
            background: #4f8762;
        }

    </style>
    <div class="content-wrapper">
        <div class="card">
            <h4 class="card-title">Module Management</h4>
            <p class="card-description">List of available tools and modules below</p>
            <div>
                      <!-- Trigger Button -->
            <button class="btn-open-modal btn btn-sm" wire:click="$set('showModal', true)">
                <i class="fas fa-cloud-upload-alt"></i> Upload Module
            </button>
            </div>

            <!-- Modal -->
            @if($showModal)
                <div class="modal-overlay">
                    <div class="modal-container">
                        <button class="close-modal" wire:click="$set('showModal', false)">×</button>
                        <h4>Upload Module Package</h4>
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
                </div>
            @endif

            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>


        <div class="card-body">
            <div class="modules-grid">
                @foreach($modules as $module)
                    <div class="module-card">
                        <i class="fas fa-puzzle-piece"></i>
                        <h3>{{ $module['name'] }}</h3>
                        @if($module['isEnabled'])
                            <button class="btn-deactivate" wire:click="deactivateModule('{{ $module['name'] }}')">
                                Deactivate
                            </button>
                        @else
                            <button class="btn-activate" wire:click="activateModule('{{ $module['name'] }}')">
                                Activate
                            </button>
                        @endif
                        <button class="btn-delete" wire:click="deleteModule('{{ $module['name'] }}')">
                            Delete
                        </button>
                    </div>
                @endforeach
            </div>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
</div>
