<div class="row clearfix">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-blue hover-expand-effect">
            <div class="icon">
                <i class="material-icons">local_offer</i>
            </div>
            <div class="content">
                <div class="text">PRODUCTOS</div>
                <div class="number count-to" data-from="0"
                    data-to="{{ isset($datos['productos']) ? $datos['productos'] : 0 }}" data-speed="900"
                    data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
                <i class="material-icons">local_shipping</i>
            </div>
            <div class="content">
                <div class="text">PYMES</div>
                <div class="number count-to" data-from="0"
                    data-to="{{ isset($datos['proveedores']) ? $datos['proveedores'] : 0 }}" data-speed="900"
                    data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-blue hover-expand-effect">
            <div class="icon">
                <i class="material-icons">view_list</i>
            </div>
            <div class="content">
                <div class="text">TIPOS</div>
                <div class="number count-to" data-from="0" data-to="{{ isset($datos['tipos']) ? $datos['tipos'] : 0 }}"
                    data-speed="900" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">bookmark</i>
            </div>
            <div class="content">
                <div class="text">MARCAS</div>
                <div class="number count-to" data-from="0"
                    data-to="{{ isset($datos['marcas']) ? $datos['marcas'] : 0 }}" data-speed="900"
                    data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
                <i class="material-icons">list</i>
            </div>
            <div class="content">
                <div class="text">MEDIDAS</div>
                <div class="number count-to" data-from="0"
                    data-to="{{ isset($datos['medidas']) ? $datos['medidas'] : 0 }}" data-speed="900"
                    data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-blue hover-expand-effect">
            <div class="icon">
                <i class="material-icons">view_list</i>
            </div>
            <div class="content">
                <div class="text">EVENTOS DE SEGURIDAD</div>
                <div class="number count-to" data-from="0"
                    data-to="{{ isset($datos['notificacion_users']) ? $datos['notificacion_users'] : 0 }}"
                    data-speed="900" data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
</div>
