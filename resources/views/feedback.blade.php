<x-app-layout>
    <div class="container" style="margin-top: 7.5rem">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card border-0 rounded-lg shadow-lg">
                    <div class="card-header bg-primary text-white text-center py-4 rounded-top">
                        <h3 class="mb-0">Gửi Đánh Giá và Góp Ý</h3>
                    </div>
                    <div class="card-body p-4">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('feedback.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên</label>
                                <input type="text" name="name" class="form-control form-control-lg" id="name" placeholder="Nhập tên của bạn" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Nhập email của bạn" required value="{{ auth()->check() ? auth()->user()->email : '' }}">
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Lời nhắn</label>
                                <textarea name="message" class="form-control form-control-lg" id="message" rows="5" placeholder="Nhập phản hồi của bạn" required></textarea>
                            </div>

                            <button type="submit" class="btn-custom w-100 py-2">Gửi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        label {
            font-weight: 500;
        }
        
        .card {
            border-radius: 1rem;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #009688, #80cbc4); /* Gradient xanh lục và xanh lá cây nhạt */
            color: #fff;
        }

        .btn-custom {
            background-color: #009688; /* Màu xanh lục */
            border: none;
            border-radius: 1.5rem;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s, border-color 0.3s;
            outline: none;
            color: #fff;
        }

        .btn-custom:hover {
            background-color: #00796b; /* Màu xanh lục đậm hơn khi hover */
            border-color: #00796b;
        }


        .form-control {
            border-radius: 0.5rem;
            border: 1px solid #ced4da;
            box-shadow: none;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }

        .alert {
            border-radius: 0.5rem;
        }
    </style>
</x-app-layout>
