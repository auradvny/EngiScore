<style>
    .hero-container {
        position: relative;
    }

    .carousel-container {
        text-align: left;
        padding-left: 10px;
        position: absolute;
        top: 20%;
        left: 0;
        transform: translateX(5%) translateY(30%);
        z-index: 10;
    }

    .hero-text {
        color: #2F3645;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-size: 50px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .hero-text span {
        color: #071952;
        /* Warna biru tua */
        /* Garis bawah */
        text-decoration-color: #7D8ABC;
        /* Warna untuk garis bawah */
        font-weight: bold;
        /* Tebalkan teks */
    }

    .sub-container {
        position: absolute;
        top: 40%;
        left: 0;
        transform: translateX(11%) translateY(0%);
        z-index: 10;
    }

    .sub-text {
        color: #2F3645;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-size: 30px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    }

    .info-text {
        /* Existing styles */
        width: 100%;
        /* Set width to full for the left section */
        float: left;
        /* Float left to position on the left side */
        clear: both;
        /* Clear any floats */
        /* margin-top: 2px; */
        margin-bottom: 5px;
        /* Add margin at the bottom */
    }

    .download-container {
        /* text-align: center; */
        transform: translateX(0%) translateY(20%);

        /* Center-align the download button */
    }

    .download-btn {
        display: inline-block;
        /* Make the button inline-block */
        padding: 10px 20px;
        font-size: 16px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        color: white;
        background-color: #2F3645;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        text-align: center;
        cursor: pointer;
    }

    .download-btn:hover {
        background-color: #3F4755;
    }
</style>

<!-- ======= Hero Section ======= -->
<section id="hero">
    <div class="hero-container">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <!-- Slide 1 -->
                <div class="carousel-item active" style="background-image: url(<?php echo base_url() ?>assets/page/img/ft.jpeg);">
                    <div class="carousel-container">
                        <h1 class="hero-text">Selamat Datang di <span>EngiScore</span></h1>
                    </div>
                    <div class="sub-container">
                        <h4 class="sub-text">Aplikasi Perhitungan Poin Mahasiswa Fakultas Teknik</h4>
                        <h7 class="info-text">Menurut Surat Keputusan Rektor Universitas Jenderal Soedirman, sebagai syarat pendadaran <br> mahasiswa diharuskan mengumpulkan poin yang diperoleh setelah mengikuti kegiatan non akademik.</h7>
                        <div class="download-container">
                            <a href="<?php echo base_url('assets/documents/ketentuan_point.pdf'); ?>" class="download-btn" target="_blank">Keputusan Rektor</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Hero -->

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
    <div class="container">
        <div class="section-title">
            <h2 style="font-family: Times, serif">Alamat Kami</h2>
        </div>
    </div>
    <div class="map">
        <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.3296722404343!2d109.33179616928102!3d-7.428722208339213!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6559814ade5b79%3A0xaef1b7bab5cba0f0!2sFakultas%20Teknik%20Universitas%20Jenderal%20Soedirman!5e0!3m2!1sid!2sid!4v1719738164939!5m2!1sid!2sid" frameborder="0" allowfullscreen></iframe>
    </div>
</section><!-- End Contact Section -->