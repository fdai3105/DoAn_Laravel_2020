@extends('home')

@section('body')
<div class="container-fluid video-info" style="padding: 0px;">
    <video width="100%" loop autoplay muted src="https://brand.assets.adidas.com/video/upload/q_auto,vc_auto/video/upload/Hometeam-Hero-Ambient-MH-BLUE_1-DT_h3xpw5.mp4" id="video1"></video>
    <div class="overlay">
        <h4>BE A HERO FOR THE HEROES</h4>
        <button type="button" class="btn btn-dark">Join With Us Now
            <i class="fa fa-angle-right"></i>
        </button>
    </div>
</div>

<div class="container-fluid two-option">
    <div class="row">
        <div class="col-md-6 first-col">
            <img src=" https://brand.assets.adidas.com/image/upload/f_auto,q_auto,fl_lossy/enUS/Images/outdoor-ss20-outdoorclp-dotcom-mh-large-d-1_tcm221-439473.jpg">
            <div class="overlay">
                <h4>ADIDAS OUTDOOR</h4>
                <p>PROTECTION FROM THE ELEMENTS WITH <br> PERFORMANCE GEAR MADE TO WEAR OUTDOORS, MOUNTAINS OR CITY.</p>

            </div>
        </div>

        <div class="col-md-6" style="height: 350px">
            <iframe width="717.600" height="350" src="https://www.youtube.com/embed/Rwk5PdpTxSU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>

</div>

<div class="container-fluid home-adidas">
    <h4>More Adidas</h4>
    <div class="row">
        <div class="col-3 ">
            <a href="">
                <div class="adidas-item">
                    <img src="https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy/cd1631e9d6fb48ccaedcaafc0106320f_9366/Ultraboost_20_Shoes_White_EF1042_01_standard.jpg" alt="">
                    <div class="overlay">
                        <h4>Adidas Shoes</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-3 ">
            <a href="">
                <div class="adidas-item">
                    <img src="https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy/73cf26589691457bbeb2ab9f00858c31_9366/Oversized_T_Shirt_Beige_GM6677_21_model.jpg" alt="">
                    <div class="overlay">
                        <h4>Adidas Clothing</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-3 ">
            <a href="">
                <div class="adidas-item">
                    <img src="https://assets.adidas.com/images/h_840,f_auto,q_auto:sensitive,fl_lossy/88af3ea09aca4b8e80b2ab75011a54a6_9366/Premium_Essentials_Toploader_Backpack_Black_GD5004_01_standard.jpg" alt="">
                    <div class="overlay">
                        <h4>Adidas Accessories</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-3 ">
            <a href="">
                <div class="adidas-item">
                    <img src="https://images.milled.com/2019-06-10/se0dEsHJpbflr6Hr/nbwkgIhD2MSo.gif" alt="">
                    <div class="overlay">
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid salah-banner">
    <div class="row">
        <div class="col-9" style="padding: 0px;">
            <video width="100%" loop autoplay playsinline muted src="https://brand.assets.adidas.com/image/upload/q_auto,vc_auto/viVN/Images/91743_LACE_Adicolor_DualGender_MASTHEAD_S_DT_1920x800_HP_tcm337-494923.mp4" __idm_id__="329040899"></video>
            <div class="overlay">
                <h4>ADICOLOR RETURNS
                </h4>
            </div>
        </div>
        <div class="col" style="background-color:darkorange;text-align:center;color:white">
            <div style="margin-top: 40%;">
                <h4>ĐĂNG KÝ NHẬN THÔNG TIN CẬP NHẬT VÀ ƯU ĐÃI QUA EMAIL!</h4>
                <form>
                    <div class="form-group">
                        <input style="background-color: #0000002a;border: #0000;color: white" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <button style="width: 50%;" type="submit" class="btn btn-dark">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection