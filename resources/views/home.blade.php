<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    @auth
        <p>Log in exitoso.</p>
        <form action="/logout" method="POST">
            @csrf
            <button>Log out</button>
        </form>

        <div style="border: 3px solid black;">
            <h2>Create Post</h2>
            <form action="/createPost" method="POST">
                <input name="title" type="text" placeholder="title">
                <textarea name="body" placeholder="content"></textarea>
                <button>Create Post</button>
            </form>
        </div>

        <div style="border: 3px solid black;">
            <h2>My Posts</h2>
            @foreach ($userPosts as $userPost)
                <div style = "border:2px solid grey;">
                    <h3>{{$userPost['title']}}</h3>
                    {{$userPost['body']}}
                    <p><a href="/edit/{{$userPost->id}}">Edit</a></p>
                    <form action="/delete/{{$userPost->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <h1>Mi Demo</h1>

        <div style="border: 3px solid black;">
            <h2>Register</h2>
            <form action="/register" method="POST">
                @csrf
                <input name="name" type="text" placeholder="name">
                <input name="email" type="email" placeholder="email">
                <input name="password" type="password" placeholder="password">
                <button>Register</button>
            </form>
        </div>

        <div style="border: 3px solid black;">
            <h2>Log in</h2>
            <form action="/login" method="POST">
                @csrf
                <input name="loginname" type="text" placeholder="name">
                <input name="loginpassword" type="password" placeholder="password">
                <button>Log in</button>
            </form>
        </div>

        <div style="border: 3px solid black;">
            <h2>All Posts</h2>
            @foreach ($posts as $post)
                <div style = "border:2px solid grey;">
                    <h3>{{$post['title']}} by {{$post->user->name}}</h3>
                    {{$post['body']}}
                </div>
            @endforeach
        </div>
    @endauth

    
</body>
</html>