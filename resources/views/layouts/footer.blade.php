<footer class="footer">
    <div class="footer-logo">
        <img src="{{ asset('images/icon.png') }}" alt="Logo" width="120">
        <div class="text">
            <strong>KHAKIEL PETSHOP</strong>
            <p>Kebutuhan hewan kucing terlengkap</p>
        </div>
    </div>

    <div class="footer-content">
        <p>Jl. Pamayahan No.20, Kukusan, Kecamatan Lohbener, Kab. Indramayu, Jawa Barat 65252</p>
        <p>Pusat Kebutuhan Hewan Peliharaan Terlengkap, Terbesar, & Terpercaya No.1 di Indonesia</p>
        <p class="wa-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
            </svg>
            <a href="https://api.whatsapp.com/send?phone=6287717649173&text=Halo%20saya%20mau%20tanya%20tentang%20Khakiel%20Petshop" target="_blank">
                WhatsApp <strong>087-717-649-173</strong>
            </a>
        </p>
    </div>
</footer>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html, body {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .container {
        flex: 1;
    }

    .footer {
        text-align: center;
        background-color: #E5CBB7;
        padding: 20px;
        width: 100vw;
        font-size: 14px;
        margin-top: auto;
        position: relative;
        left: 0;
        font-family: 'Poppins', sans-serif;
    }

    .footer-logo {
        display: flex;
        align-items: center;
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        gap: 10px;
    }

    .footer-logo .text {
        text-align: left;
    }

    .footer a {
        color: #2c3e50;
        text-decoration: none;
        font-weight: bold;
    }

    .wa-link svg {
        vertical-align: middle;
        margin-right: 5px;
    }

    .footer-content {
        max-width: 700px;
        margin: 0 auto;
    }
</style>
