<!DOCTYPE html>
<html>
<head>
    <title>eVendas</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #ffffff;
        }
        .navbar {
            background-color: #f44336;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }
        .logo img {
            height: 50px;
            width: auto;
        }
        .login {
            margin-right: 20px;
        }
        .btn-login {
            background-color: #ffffff;
            color: #f44336;
            font-size: 1.5rem;
            border: none;
            padding: 3px 11px;
            cursor: pointer;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3);
        }
        .btn-login:hover {
            background-color: #f1f1f1;
        }
        .carousel {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            overflow: hidden;
            position: relative;
            height: 300px;
        }

        .carousel .slides {
            display: flex;
            transition: all 1s;
            height: 100%;
        }

        .carousel .slide {
            flex: 0 0 100%;
            height: 100%;
        }
        .bottom-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #333333;
            padding: 10px;
            color: #ffffff;
            text-align: center;
            display: none;
        }
        @media (max-width: 768px) {
            .bottom-bar {
                display: block;
            }
        }
        .presentation {
            max-width: 800px;
            margin: 20px auto;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <img src="logo.png" alt="Logo">
        </div>
        <div class="login">
            <a href="./login/index.php" class="btn-login">Login</a>
        </div>
    </div>
    <div class="carousel">
        <div class="slides">
            <div class="slide" style="background-color: #ffcc00;"></div>
            <div class="slide" style="background-color: #00ccff;"></div>
            <div class="slide" style="background-color: #99ff33;"></div>
        </div>
    </div>
    <div class="bottom-bar">
        <a href="#">Falar com um atendente</a> | <a href="#">Fazer um teste na plataforma</a>
    </div>
    <div class="presentation">
        <h2>Resumo</h2>
        <p>um dia vejo se vale a pena</p>
    </div>

    <script>
        const slides = document.querySelector('.slides');
        let slideIndex = 0;

        function showSlides() {
            slideIndex++;
            if (slideIndex > slides.children.length) {
                slideIndex = 1;
            }
            slides.style.transform = `translateX(-${(slideIndex - 1) * 100}%)`;
            setTimeout(showSlides, 2000);
        }
        showSlides();
    </script>
</body>
</html>
