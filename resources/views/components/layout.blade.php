<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ecommerce</title>
    @vite(['resources/css/app.css','resourrces/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kodchasan:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body>

    <nav class="flex justify-between p-5 bg-[#ebeae8]">
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
