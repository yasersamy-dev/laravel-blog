<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow-sm p-4" style="max-width:420px; width:100%;">
        <h2 class="h4 text-center mb-3">تسجيل الدخول</h2>

        {{-- عرض رسائل النجاح أو الأخطاء --}}
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div class="mb-3">
       <label for="email" class="form-label">البريد الإلكتروني</label>
         <input id="email"
           type="email"
           name="email"
           value="{{ old('email') }}"
           class="form-control @error('email') is-invalid @enderror"
           autocomplete="email"
           autofocus>
         @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
          </div>


            <div class="mb-3">
                <label for="password" class="form-label">كلمة المرور</label>
                <input id="password"
                       type="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       
                       autocomplete="current-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">دخول</button>
        </form>

        <div class="text-center mt-3">
            <small>لو عايز تضيف بيانات تانية بعدين تقدر تعمل <a href="{{ route('register') }}">إنشاء حساب كامل</a></small>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
