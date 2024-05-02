<div class="row clearfix">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-blue hover-expand-effect">
            <div class="icon">
                <i class="material-icons">local_offer</i>
            </div>
            <div class="content">
                <div class="text">PRODUCTOS</div>
                <div class="number count-to" data-from="0" data-to="{{$datos['productos']}}" data-speed="900" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">people</i>
            </div>
            <div class="content">
                <div class="text">USUARIOS</div>
                <div class="number count-to" data-from="0" data-to="{{$datos['usuarios']}}" data-speed="900" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
                <i class="material-icons">local_shipping</i>
            </div>
            <div class="content">
                <div class="text">PYMES</div>
                <div class="number count-to" data-from="0" data-to="{{$datos['proveedores']}}" data-speed="900" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
</div>