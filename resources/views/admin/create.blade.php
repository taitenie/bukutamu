<form action="{{ route('admin.store') }}" method="POST">
    @csrf
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <button type="submit">Create Admin</button>
</form>
