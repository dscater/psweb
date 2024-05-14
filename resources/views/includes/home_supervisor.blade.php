<div class="row clearfix">
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
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">people</i>
            </div>
            <div class="content">
                <div class="text">USUARIOS ROLES</div>
                <div class="number count-to" data-from="0"
                    data-to="{{ isset($datos['usuarios']) ? $datos['usuarios'] : 0 }}" data-speed="900"
                    data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
                <i class="material-icons">view_list</i>
            </div>
            <div class="content">
                <div class="text">EVENTOS - ANTENTICACIÓN SEGURA</div>
                <div class="number count-to" data-from="0"
                    data-to="{{ isset($datos['autenticacion_seguras']) ? $datos['autenticacion_seguras'] : 0 }}" data-speed="900"
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
                <div class="text">EVENTOS - AUTORIZACIÓN ADECUADA</div>
                <div class="number count-to" data-from="0"
                    data-to="{{ isset($datos['autorizacion_adecuadas']) ? $datos['autorizacion_adecuadas'] : 0 }}" data-speed="900"
                    data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">view_list</i>
            </div>
            <div class="content">
                <div class="text">PREVENCIÓN DE ATAQUES</div>
                <div class="number count-to" data-from="0"
                    data-to="{{ isset($datos['prevension_ataques']) ? $datos['prevension_ataques'] : 0 }}" data-speed="900"
                    data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-orange hover-expand-effect">
            <div class="icon">
                <i class="material-icons">view_list</i>
            </div>
            <div class="content">
                <div class="text">RESPALDO Y RECUPERACIÓN</div>
                <div class="number count-to" data-from="0"
                    data-to="{{ isset($datos['respaldo_db']) ? $datos['respaldo_db'] : 0 }}" data-speed="900"
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
                <div class="text">ESCANEO DE VULNERABILIDADES</div>
                <div class="number count-to" data-from="0"
                    data-to="{{ isset($datos['escaneo_vulnerabilidades']) ? $datos['escaneo_vulnerabilidades'] : 0 }}" data-speed="900"
                    data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="info-box bg-cyan hover-expand-effect">
            <div class="icon">
                <i class="material-icons">view_list</i>
            </div>
            <div class="content">
                <div class="text">CAPACITCACIÓN EN SEGURIDAD</div>
                <div class="number count-to" data-from="0"
                    data-to="{{ isset($datos['capacitacion_seguridads']) ? $datos['capacitacion_seguridads'] : 0 }}" data-speed="900"
                    data-fresh-interval="20"></div>
            </div>
        </div>
    </div>
</div>
