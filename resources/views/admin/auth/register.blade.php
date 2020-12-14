<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <form method="POST" action="{{ route('admin.register') }}" enctype="multipart/form-data">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @csrf
        <input type="text" name="name" placeholder="name">
        <input type="text" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <button type="submit">Register</button>
    </form>
</body>
</html>