<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es"> 
    <head> 
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8">
        <title>RECURSOS HUMANOS</title> 
        <?php echo $html->charset('utf-8'); ?>   

        <?php echo $this->Html->css('semantic.css'); ?>   
        <?php echo $this->Html->css('calendar.min.css'); ?>  
        <?php echo $this->Html->script('jquery.js'); ?>
        <?php echo $this->Html->script('semantic.js'); ?> 
        <?php echo $this->Html->script('calendar.js'); ?>   

    </head> 
    <body>      


        <div class="ui left vertical menu sidebar inverted ">
            <div class="item">
                <!--<h2 class="ui center aligned icon header inverted">
<i class="chess king icon"></i>
Labora GT
</h2>-->

                <img  class="ui centered image small" src="/GestorRRHH/img/LaboraGT-logo-noText.png" alt="">
            </div>

            <a class="item" href="/GestorRRHH/"> Inicio</a>            
            <div class="item">
                Operación
                <i class="whmcs icon"></i>
                <div class="menu">
                    <a class="item" href="/GestorRRHH/empleados">Personal</a>
                </div>
            </div>
            <div class="item">
                Procesos
                <i class="whmcs icon"></i>
                <div class="menu">
                    <a class="item" href="/GestorRRHH/ajustes" >Puestos</a>
                    <a class="item" href="/GestorRRHH/ausencias">Ausencias</a>
                    <a class="item" href="/GestorRRHH/horas_extras" >Horas Extras</a>
                </div>
            </div>
            <div class="item">
                Nominas
                <i class="whmcs icon"></i>
                <div class="menu">
                    <a class="item" href="/GestorRRHH/nominas" >Generación de Nomina</a>
                </div>
            </div>
            <div class="item">
                Parametrización de usuario
                <i class="whmcs icon"></i>
                <div class="menu">
                    <a class="item" >Asignaciones</a>
                    <a class="item" >Deducciones</a>
                    <a class="item" href="/GestorRRHH/eventualidades">Eventualidades</a>
                    <a class="item" >Bonos Especiales</a>
                    <a class="item" href="/GestorRRHH/contratos" >Contratos</a>
                </div>
            </div>
            <div class="item">
                Mantenimientos
                <i class="whmcs icon"></i>
                <div class="menu">
                    <a class="item" href="/GestorRRHH/cargos">Cargos</a>
                    <a class="item" href="/GestorRRHH/departamentos">Departamentos</a>
                    <a class="item" href="/GestorRRHH/programas">Programas</a>
                    <a class="item" href="/GestorRRHH/feriados" >Dias Feriados</a>
                </div>
            </div>
            <div class="item">
                Reportes
                <i class="whmcs icon"></i>
                <div class="menu">
                    <a class="item" href="/GestorRRHH/reportes/generar_reportes">Generación de reportes</a>
                </div>
            </div>
        </div>

        <div class="pusher">
            <!-- Site content !-->
            <div class="ui segment inverted teal vertical">
                <div class="ui container">
                    <div class="ui secondary inverted   menu">
                        <a class="item btn my-menu active">
                            <i class="bars icon"></i>
                            Menú
                        </a>
                        <div class="ui right dropdown item config" tabindex="0">
                            <i class="user circle icon"></i>
                            <?php echo '( ' . Authsome::get('USERNAME') . ') ' . Authsome::get('NOMBRE') . ' ' . Authsome::get('APELLIDO') ?>
                            <i class="dropdown icon"></i>
                            <div class="menu transition hidden" tabindex="-1">
                                <!--<a class="item"><i class="cog icon"></i>Configurar</a>-->
                                <a class="item" href="/GestorRRHH/users/logout">
                                    <i class="power off icon"></i>
                                    Salir 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php echo $content_for_layout; ?>
            <!--Content Site-->
        </div> 


        <script>
            $(document).ready(function () {
                $(".btn.my-menu").click(function () {
                    $('.sidebar')
                        .sidebar('setting', 'transition', 'overlay')
                        .sidebar('toggle');
                });
                //habilitacion de dropdown
                $('.ui.dropdown').dropdown();

                $('.menu .item')
                    .tab()
                ;
                $('#calendar').calendar({
                    type: 'date',
                    monthFirst: false,
                    formatter: {
                        date: function (date, settings) {
                            if (!date) return '';
                            var day = date.getDate();
                            var month = date.getMonth() + 1;
                            var year = date.getFullYear();
                            return day + '-' + month + '-' + year ;
                        }
                    }
                });
                $('#calendarIngreso').calendar({
                    type: 'date',
                    monthFirst: false,
                    formatter: {
                        date: function (date, settings) {
                            if (!date) return '';
                            var day = date.getDate();
                            var month = date.getMonth() + 1;
                            var year = date.getFullYear();
                            return day + '-' + month + '-' + year ;
                        }
                    }
                });
            });
        </script>
    </body>
</html>

