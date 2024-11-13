<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="images/favicon.ico" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#ef3b2d",
                    },
                },
            },
        };
    </script>
    <title>LaraGigs | Find Laravel Jobs & Projects</title>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Container -->
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-laravel mb-8">LaraGigs - Find Laravel Jobs & Projects</h1>

        <!-- Search Form -->
        <form method="GET" action="{{ route('users.index') }}" class="mb-8 flex space-x-4 items-center">
            <div>
                <select name="search_field" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-laravel focus:border-laravel">
                    <option value="name" {{ request('search_field') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="email" {{ request('search_field') == 'email' ? 'selected' : '' }}>Email</option>
                    <option value="lastname" {{ request('search_field') == 'lastname' ? 'selected' : '' }}>Lastname</option>
                </select>
            </div>
            <div>
                <input
                    type="text"
                    name="search_query"
                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring-laravel focus:border-laravel"
                    value="{{ request('search_query') }}"
                    placeholder="Search..."
                />
            </div>
            <button
                type="submit"
                class="bg-laravel text-white px-4 py-2 rounded-lg hover:bg-red-600 transition duration-200">
                <i class="fas fa-search"></i> Search
            </button>
        </form>

        <!-- User Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Lastname</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-light">
                    @foreach ($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6">{{ $user->id }}</td>
                            <td class="py-3 px-6">{{ $user->name }}</td>
                            <td class="py-3 px-6">{{ $user->email }}</td>
                            <td class="py-3 px-6">{{ $user->lastname }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>

</body>
</html>
