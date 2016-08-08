<?php

/* NestleCoreBundle:Core:login.html.twig */
class __TwigTemplate_30e72b9c3f3cedb4e0a6e7ac3880614b8022f12420d2183acede0fcdd68771d5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascript' => array($this, 'block_javascript'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<!DOCTYPE html>
<html lang=\"en\">
<head>
\t<meta charset=\"UTF-8\">
\t<title>Nestle BOW Web App</title>
\t<meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\" />
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" />
    <meta name=\"robots\" content=\"noindex, nofollow\" />

    ";
        // line 12
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 26
        echo "</head>
<body>
\t<div id=\"page-wrapper\" style=\"padding-top: 30px;\">
\t\t<div class=\"row\">

\t\t\t<div class=\"col-sm-5 col-sm-offset-3 col-md-4 col-md-offset-4 loginBox\" style=\"background: none;\">

\t\t\t\t<div class=\"row\">
\t                <div class=\"col-md-12\">
\t                    <img src=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("img/bower_logo.png"), "html", null, true);
        echo "\" alt=\"\" style=\"max-width: 50%\" />
\t                </div>
\t            </div>

\t            <div class=\"row\">
\t                <form action=\"";
        // line 40
        echo $this->env->getExtension('routing')->getPath("_security_check");
        echo "\" method=\"post\" class=\"form-login\" role=\"form\" id=\"loginForm\">
\t                \t<div class=\"col-md-12\">
\t\t                    <div class=\"input-group\">
\t\t                        <span id=\"basic-addon\" class=\"input-group-addon\">
\t\t                            <i class=\"fa fa-user\"></i>
\t\t                        </span>
\t\t                        <input class=\"form-control input-lg\" name=\"_username\" id=\"username\" type=\"text\" aria-describedby=\"basic-addon1\" placeholder=\"Username\">
\t\t                    </div>
\t\t                </div>

\t\t                <div class=\"col-md-12\">
\t\t                    <div class=\"input-group\">
\t\t                        <span id=\"basic-addon\" class=\"input-group-addon\">
\t\t                            <i class=\"fa fa-shield\"></i>
\t\t                        </span>
\t\t                        <input class=\"form-control input-lg\" name=\"_password\" id=\"password\" type=\"password\" aria-describedby=\"basic-addon1\" placeholder=\"Password\">
\t\t                    </div>
\t\t                </div>

\t\t                <div class=\"col-md-12\">
\t\t                    <button id=\"login\" class=\"btn btn-info btn-lg\" type=\"submit\">LOGIN</button>
\t\t\t\t\t\t\t";
        // line 62
        echo "\t\t\t\t\t\t\t";
        if ((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error"))) {
            // line 63
            echo "\t\t\t\t\t\t\t\t<div class=\"alert alert-danger\" role=\"alert\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "message", array()), "html", null, true);
            echo "</div>
\t\t\t\t\t\t\t";
        }
        // line 65
        echo "\t\t                </div>
\t                </form>
\t            </div>

\t\t\t</div>

\t\t</div>
\t</div>

\t";
        // line 74
        $this->displayBlock('javascript', $context, $blocks);
        // line 117
        echo "</body>
</html>";
    }

    // line 12
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 13
        echo "    \t<link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/bootstrap.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
    \t<link href=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/metisMenu.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
    \t<link href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/style.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
    \t<link href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/fontello.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
    \t<link href=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/linear-icons.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
    \t<link href=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/Pe-icon-7-stroke.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
    \t<link href=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/jasny-bootstrap.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
    \t<link href=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/summernote.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
    \t<link href=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/ammap.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
    \t<link href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/jquery.dataTables.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
    \t<link href=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/dataTables.colVis.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
    \t<link href=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/font-awesome.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
\t";
    }

    // line 74
    public function block_javascript($context, array $blocks = array())
    {
        // line 75
        echo "\t\t<script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery1.11.1.min.js"), "html", null, true);
        echo "\"></script>
\t    <script src=\"";
        // line 76
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/bootstrap.min.js"), "html", null, true);
        echo "\"></script>
\t    <script src=\"";
        // line 77
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/metisMenu.min.js"), "html", null, true);
        echo "\"></script>
\t    <script src=\"";
        // line 78
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jqueryui.min.js"), "html", null, true);
        echo "\"></script>
\t    <script src=\"";
        // line 79
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery.dataTables.min.js"), "html", null, true);
        echo "\"></script>
\t    <script src=\"";
        // line 80
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/dataTables.colVis.min.js"), "html", null, true);
        echo "\"></script>
\t    <script src=\"";
        // line 81
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/summernote.js"), "html", null, true);
        echo "\"></script>
\t    <script src=\"";
        // line 82
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/sb-admin-2.js"), "html", null, true);
        echo "\"></script>
\t    <script src=\"";
        // line 83
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jasny-bootstrap.js"), "html", null, true);
        echo "\"></script>
\t    <script src=\"";
        // line 84
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/equalheight.js"), "html", null, true);
        echo "\"></script>

\t    <script>

\t\t\tvar login = \$('#login');
\t\t\tlogin.prop('disabled', true);
\t\t\tcheck();

\t\t\tfunction check(){
\t\t\t\tvar username = \$('#username').val();
\t\t\t\tvar password = \$('#password').val();
\t\t\t\tif(username != '' && password != ''){
\t\t\t\t\tlogin.prop('disabled', false);
\t\t\t\t}else{
\t\t\t\t\tlogin.prop('disabled', true);
\t\t\t\t}
\t\t\t}

\t\t\t\$('#username').change(function() {
\t\t\t\tcheck();
\t\t\t});

\t\t\t\$('#password').change(function() {
\t\t\t\tcheck();
\t\t\t});


\t    \tlogin.click(function(e) {
\t    \t\te.preventDefault();
\t\t\t\t\$('#loginForm').submit();
\t    \t});
\t    </script>
\t";
    }

    public function getTemplateName()
    {
        return "NestleCoreBundle:Core:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  200 => 84,  196 => 83,  192 => 82,  188 => 81,  184 => 80,  180 => 79,  176 => 78,  172 => 77,  168 => 76,  163 => 75,  160 => 74,  154 => 24,  150 => 23,  146 => 22,  142 => 21,  138 => 20,  134 => 19,  130 => 18,  126 => 17,  122 => 16,  118 => 15,  114 => 14,  109 => 13,  106 => 12,  101 => 117,  99 => 74,  88 => 65,  82 => 63,  79 => 62,  55 => 40,  47 => 35,  36 => 26,  34 => 12,  21 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <!DOCTYPE html>*/
/* <html lang="en">*/
/* <head>*/
/* 	<meta charset="UTF-8">*/
/* 	<title>Nestle BOW Web App</title>*/
/* 	<meta charset="utf-8">*/
/*     <meta http-equiv="X-UA-Compatible" content="IE=edge" />*/
/*     <meta name="viewport" content="width=device-width, initial-scale=1" />*/
/*     <meta name="robots" content="noindex, nofollow" />*/
/* */
/*     {% block stylesheets %}*/
/*     	<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />*/
/*     	<link href="{{ asset('css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" media="all" />*/
/*     	<link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all" />*/
/*     	<link href="{{ asset('css/fontello.css') }}" rel="stylesheet" type="text/css" media="all" />*/
/*     	<link href="{{ asset('css/linear-icons.css') }}" rel="stylesheet" type="text/css" media="all" />*/
/*     	<link href="{{ asset('css/Pe-icon-7-stroke.css') }}" rel="stylesheet" type="text/css" media="all" />*/
/*     	<link href="{{ asset('css/jasny-bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />*/
/*     	<link href="{{ asset('css/summernote.css') }}" rel="stylesheet" type="text/css" media="all" />*/
/*     	<link href="{{ asset('css/ammap.css') }}" rel="stylesheet" type="text/css" media="all" />*/
/*     	<link href="{{ asset('css/jquery.dataTables.css') }}" rel="stylesheet" type="text/css" media="all" />*/
/*     	<link href="{{ asset('css/dataTables.colVis.css') }}" rel="stylesheet" type="text/css" media="all" />*/
/*     	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" media="all" />*/
/* 	{% endblock %}*/
/* </head>*/
/* <body>*/
/* 	<div id="page-wrapper" style="padding-top: 30px;">*/
/* 		<div class="row">*/
/* */
/* 			<div class="col-sm-5 col-sm-offset-3 col-md-4 col-md-offset-4 loginBox" style="background: none;">*/
/* */
/* 				<div class="row">*/
/* 	                <div class="col-md-12">*/
/* 	                    <img src="{{ asset('img/bower_logo.png') }}" alt="" style="max-width: 50%" />*/
/* 	                </div>*/
/* 	            </div>*/
/* */
/* 	            <div class="row">*/
/* 	                <form action="{{ path('_security_check') }}" method="post" class="form-login" role="form" id="loginForm">*/
/* 	                	<div class="col-md-12">*/
/* 		                    <div class="input-group">*/
/* 		                        <span id="basic-addon" class="input-group-addon">*/
/* 		                            <i class="fa fa-user"></i>*/
/* 		                        </span>*/
/* 		                        <input class="form-control input-lg" name="_username" id="username" type="text" aria-describedby="basic-addon1" placeholder="Username">*/
/* 		                    </div>*/
/* 		                </div>*/
/* */
/* 		                <div class="col-md-12">*/
/* 		                    <div class="input-group">*/
/* 		                        <span id="basic-addon" class="input-group-addon">*/
/* 		                            <i class="fa fa-shield"></i>*/
/* 		                        </span>*/
/* 		                        <input class="form-control input-lg" name="_password" id="password" type="password" aria-describedby="basic-addon1" placeholder="Password">*/
/* 		                    </div>*/
/* 		                </div>*/
/* */
/* 		                <div class="col-md-12">*/
/* 		                    <button id="login" class="btn btn-info btn-lg" type="submit">LOGIN</button>*/
/* 							{#}<a href="#" data-toggle="modal" data-target="#recoverPw">FORGOT PASSWORD?</a>{#}*/
/* 							{% if error %}*/
/* 								<div class="alert alert-danger" role="alert">{{ error.message }}</div>*/
/* 							{% endif %}*/
/* 		                </div>*/
/* 	                </form>*/
/* 	            </div>*/
/* */
/* 			</div>*/
/* */
/* 		</div>*/
/* 	</div>*/
/* */
/* 	{% block javascript %}*/
/* 		<script src="{{ asset('js/jquery1.11.1.min.js') }}"></script>*/
/* 	    <script src="{{ asset('js/bootstrap.min.js') }}"></script>*/
/* 	    <script src="{{ asset('js/metisMenu.min.js') }}"></script>*/
/* 	    <script src="{{ asset('js/jqueryui.min.js') }}"></script>*/
/* 	    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>*/
/* 	    <script src="{{ asset('js/dataTables.colVis.min.js') }}"></script>*/
/* 	    <script src="{{ asset('js/summernote.js') }}"></script>*/
/* 	    <script src="{{ asset('js/sb-admin-2.js') }}"></script>*/
/* 	    <script src="{{ asset('js/jasny-bootstrap.js') }}"></script>*/
/* 	    <script src="{{ asset('js/equalheight.js') }}"></script>*/
/* */
/* 	    <script>*/
/* */
/* 			var login = $('#login');*/
/* 			login.prop('disabled', true);*/
/* 			check();*/
/* */
/* 			function check(){*/
/* 				var username = $('#username').val();*/
/* 				var password = $('#password').val();*/
/* 				if(username != '' && password != ''){*/
/* 					login.prop('disabled', false);*/
/* 				}else{*/
/* 					login.prop('disabled', true);*/
/* 				}*/
/* 			}*/
/* */
/* 			$('#username').change(function() {*/
/* 				check();*/
/* 			});*/
/* */
/* 			$('#password').change(function() {*/
/* 				check();*/
/* 			});*/
/* */
/* */
/* 	    	login.click(function(e) {*/
/* 	    		e.preventDefault();*/
/* 				$('#loginForm').submit();*/
/* 	    	});*/
/* 	    </script>*/
/* 	{% endblock %}*/
/* </body>*/
/* </html>*/
