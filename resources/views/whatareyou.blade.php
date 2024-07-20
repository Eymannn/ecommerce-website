<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>register</title>
    @vite(['resources/css/app.css','resourrces/js/app.js'])
</head>
<body>
    <div class="flex w-[700px] h-[300px] bg-slate-200 mx-auto mt-[150px] text-center rounded-xl">
        <div class=" flex w-[50%] h-full items-end mx-auto justify-center bg-slate-400 rounded-l-xl"
        style="background-image: url('/images/seller.jpg');
        background-size: cover;
        background-position: center;
        opacity: 90%;
        "
        
        >
           <a href="/register/seller"> <button class="w-[200px] py-6 bg-emerald-200 rounded-2xl"> Seller</button></a>
        </div>
        <div class=" flex w-[50%] h-full items-end justify-center mx-auto bg-slate-400 rounded-r-xl"
        style="background-image: url('/images/customer.webp');
        background-size: cover;
        background-position: center;
        
        "

        >
    <a href="/register/customer"><button class="w-[200px]  py-6 bg-emerald-200 rounded-2xl "> Customer</button></a> 
        </div>
        </div>
</body>
</html>
