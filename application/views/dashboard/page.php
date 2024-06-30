<style>
    .hero-container {
        position: relative;
    }
    .carousel-container {
        text-align: left;
        padding-left: 10px; /* Mengurangi padding kiri untuk membuatnya lebih ke kiri */
        position: absolute;
        top: 20%; /* Sesuaikan nilai ini untuk mengatur posisi vertikal */
        left: 0;
        transform: translateY(-20%) translateX(-20%); /* Menambahkan translateX untuk menggeser ke kiri */
    }
    .hero-text {
        color: white;
        font-family: Georgia, 'Times New Roman', Times, serif;
        font-size: 50px;
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
                        <h1 class="hero-text">Selamat Datang di EngiScore</h1>
                    </div>
                    <div class="carousel-container2">
                      
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

</main><!-- End #main -->
