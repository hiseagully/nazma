<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NaZMaLogy Footer</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }
        
        .footer {
            background-color: #2A2A72;
            color: white;
            position: relative;
            overflow: hidden;
            padding: 2rem 7%;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 2;
        }
        
        .footer-left {
            max-width: 450px;
        }
        
        .footer-logo {
            display: flex;
            align-items: center;
            margin-bottom: 0.8rem;
        }
        
        .logo-icon {
            margin-right: 0.5rem;
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        footer.logo-text {
            font-size: 24px;
            font-weight: 700, bold;
            color: white;
            font-family: 'Poppins', sans-serif;
        }
        
        .footer-desc {
            font-size: 0.9rem;
            line-height: 1.5;
            opacity: 0.9;
        }
        
        .footer-right h3 {
            margin-bottom: 1rem;
            font-size: 1rem;
            font-weight: 500;
        }
        
        .social-icons {
            display: flex;
            gap: 1rem;
        }
        
        .social-icons a {
            color: white;
            font-size: 1.2rem;
        }
        
        .footer-divider {
            height: 1px;
            background-color: rgba(255, 255, 255, 0.1);
            margin: 0.5rem 0 1rem;
        }
        
        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
            position: relative;
            z-index: 2;
        }
        
        .copyright {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.75rem;
        }
        
        .footer-links {
            display: flex;
            gap: 1.5rem;
        }
        
        .footer-links a {
            color: white;
            text-decoration: none;
            font-size: 0.75rem;
        }
        
        .footer-links a:hover {
            text-decoration: underline;
        }
        
        /* Decorative elements */
        .corner-element {
            position: absolute;
        }
        
        .top-left {
            top: 0;
            left: 0;
        }
        
        .bottom-right {
            bottom: 0;
            right: 0;
            transform: rotate(180deg);
        }
        
        .corner-circles {
            position: relative;
            width: 150px;
            height: 150px;
            overflow: hidden;
        }
        
        .circle {
            position: absolute;
            border-radius: 50%;
        }
        
        .yellow-circle {
            background-color: #FFB800;
            width: 70px;
            height: 70px;
            top: -20px;
            left: -20px;
        }
        
        .teal-circle {
            background-color: #03B5CB;
            width: 100px;
            height: 100px;
            top: 10px;
            left: 30px;
        }
        
        .white-circle {
            background-color: white;
            width: 40px;
            height: 40px;
            top: 90px;
            left: -5px;
        }
    </style>
</head>
<body>
    <footer class="footer">
        <!-- Decorative corner elements -->
        <div class="corner-element top-left">
            <div class="corner-circles">
                <div class="circle yellow-circle"></div>
                <div class="circle teal-circle"></div>
                <div class="circle white-circle"></div>
            </div>
        </div>
        
        <div class="corner-element bottom-right">
            <div class="corner-circles">
                <div class="circle yellow-circle"></div>
                <div class="circle teal-circle"></div>
                <div class="circle white-circle"></div>
            </div>
        </div>
        
        <div class="footer-content">
            <div class="footer-left">
                <div class="footer-logo">
                    <div class="logo-icon">⟨/⟩</div>
                    <div class="logo-text">NaZMaLogy</div>
                </div>
                <p class="footer-desc">With Nazvite, Learn and Empower Yourself for the Future. Join Interactive Trainings and Support Quality Local Product</p>
            </div>
            
            <div class="footer-right">
                <h3>Kontak Kami</h3>
                <div class="social-icons">
                    <a href="#" aria-label="Email">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4.7-8 5.334L4 8.7V6.297l8 5.333 8-5.333V8.7z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="Instagram">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="Facebook">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.593 1.323-1.325V1.325C24 .593 23.407 0 22.675 0z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="LinkedIn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="TikTok">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                        </svg>
                    </a>
                    <a href="#" aria-label="YouTube">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="footer-divider"></div>
        
        <div class="footer-bottom">
            <div class="copyright">
                © Copyright 2025. - Develop by NaZMaLogy.
            </div>
            <div class="footer-links">
                <a href="#">Tentang Kami</a>
                <a href="#">Terms and Conditions</a>
                <a href="#">Privacy Policy</a>
            </div>
        </div>
    </footer>
</body>
</html>