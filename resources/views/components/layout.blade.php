<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ecommerce</title>
    @vite(['resources/css/app.css','resourrces/js/app.js'])

</head>

<body>

    <nav class="flex justify-between p-5 bg-slate-400">
        <a href="/">STORE</a>
        <ul>
            @guest
            <div class="flex space-x-5">
                <a href="/login">
                    <li>Login</li>
                </a>
                <a href="/register">
                      Register
                </a>
            </div>    
            @endguest
        @auth
            <a href="/dashboard/d">Dashboard</a>  
            
            
        @endauth
       
        
        
            

          

        </ul>
    </nav>
    <main>
        {{ $slot }}
    </main>

</body>

</html>
