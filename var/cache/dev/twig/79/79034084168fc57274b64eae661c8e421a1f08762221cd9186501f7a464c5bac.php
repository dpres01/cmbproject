<?php

/* base.html.twig */
class __TwigTemplate_cbe4c48281fec083b73ec8c5bbe5f9145b9a3cc1baa5ab607a945005f2c24c39 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <title>";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 7
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 8
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />\t
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("public/css/bootstrap.min.css"), "html", null, true);
        echo "\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("public/css/bootstrap.css"), "html", null, true);
        echo "\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("public/css/jquery-ui.css"), "html", null, true);
        echo "\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("public/css/commun.css"), "html", null, true);
        echo "\">
        <script src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("public/js/jquery-1.10.2.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("public/js/jquery-ui.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("public/js/bootstrap.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("public/js/bootstrap.min.js"), "html", null, true);
        echo "\"></script>
\t\t<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>
    <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>
    </head>
    <body>
\t    <!--******************************* En tête principale ************************************-->
        <div class=\"head\">
\t\t\t<div class=\"nivhead\" >
\t\t\t\t<div style=\"border:0px solid #80BFFF;padding:20px 0 0 0;\">
\t\t\t\t\t<div style=\"float:right;border: 0px solid green;width:410px;height:50px;\">
\t\t\t\t\t\t<div style=\"float:left;border-right:1px solid #ccc;height:100%;width:165px;padding:5px 0 0 0;\">
\t\t\t\t\t\t\t<div style=\"float:left;padding:8px 0px 0 0;width:50px;border:0px solid #000;text-align:center;\">
\t\t\t\t\t\t\t\t<span class=\"glyphicon glyphicon-user\" ></span>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\" style=\"font-size:25px;color:#28C4E0;\"></span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div style=\"float:left;width:110px;border:0px solid #000;\">
\t\t\t\t\t\t\t\t<div style=\"margin:2px 0 0px 0;font-size:14px;color:#28C4E0;\">
\t\t\t\t\t\t\t\t\t\t  MON ESPACE
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div style=\"margin:0 0 0px 0;font-size:12px;\">
\t\t\t\t\t\t\t\t";
        // line 39
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("IS_AUTHENTICATED_REMEMBERED")) {
            // line 40
            echo "\t\t\t\t\t\t\t\tBienvenu ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["app"] ?? $this->getContext($context, "app")), "user", array()), "username", array()), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t<a href=\"";
            // line 41
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("fos_user_security_logout");
            echo "\">
\t\t\t\t\t\t\t\t\t";
            // line 42
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("layout.logout", array(), "FOSUserBundle"), "html", null, true);
            echo "
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t";
        } else {
            // line 45
            echo "\t\t\t\t\t\t\t\t\t<a href=\"#\"> Connectez-vous </a>
\t\t\t\t\t\t\t\t";
        }
        // line 47
        echo "\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div style=\"float:left;width:245px;padding:5px 0 0 10px;\">
\t\t\t\t\t\t\t<div style=\"float:left;padding:8px 0px 0 0;width:50px;border:0px solid #000;text-align:center;\">
\t\t\t\t\t\t\t\t<span class=\"glyphicon glyphicon-earphone\" aria-hidden=\"true\" style=\"font-size:25px;color:#28C4E0;\"></span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div style=\"float:left;width:175px;border:0px solid #000;\">
\t\t\t\t\t\t\t\t<div style=\"margin:2px 0 0px 0;font-size:14px;color:#28C4E0;\"><b>Contactez Nous</b></div>
\t\t\t\t\t\t\t\t<div style=\"margin:0 0 0px 0;font-size:12px;\">du lundi au samedi de 9h à 18h</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t</div>
\t\t\t</div>
\t    </div>
\t\t<!--******************************* Menu principale ************************************-->
        <nav class=\"navbar navbar-expand-lg navbar-light \">
            <a class=\"navbar-brand\" href=\"#\"><strong>Zandoo</strong></a>
            <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarNavAltMarkup\" aria-controls=\"navbarNavAltMarkup\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
              <span class=\"navbar-toggler-icon\"></span>
            </button>
            <div class=\"collapse navbar-collapse\" id=\"navbarNavAltMarkup\">
              <div class=\"navbar-nav\">
                <a class=\"nav-item nav-link active\" href=\"#\"> <span class=\"sr-only\">(current)</span></a>
                <a class=\"nav-item nav-link\" href=\"#\">ARTICLES</a>
                <a class=\"nav-item nav-link\" href=\"#\">BOUTIQUES</a>
                <a class=\"nav-item nav-link put-annonce\" href=\"#\"><strong>DEPOSER UNE ANNONCE</strong></a>
              </div>
            </div>  
        </nav>
        ";
        // line 79
        $this->displayBlock('body', $context, $blocks);
        // line 80
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 81
        echo "        <footer>
            <div class=\"nivfooter\">
\t\t\t<div class=\"nivfootermin\">
\t\t\t\t<a href=\"#\" > Plan du site </a>
\t\t\t</div>
\t\t\t<div class=\"nivfootermax\">
\t\t\t\t<a href=\"#\" > Qui sommes-nous ? </a>
\t\t\t</div>
\t\t\t<div class=\"nivfootermax\">
\t\t\t\t<a href=\"#\" > Nos équipes & Recrutement </a>
\t\t\t</div>
\t\t\t<div class=\"nivfootermax\">
\t\t\t\t<a href=\"#\" >Témoignages clients </a>
\t\t\t</div>
\t\t\t<div class=\"nivfootermin\">
\t\t\t\t<a href=\"#\" > Nous contacter </a>
\t\t\t</div>
\t\t\t<div class=\"nivfootermin\">
\t\t\t\t<a href=\"#\" > CGV </a>
\t\t\t</div>
\t\t\t<div class=\"nivfootermin\">
\t\t\t\t<a href=\"#\"> Affiliation </a>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"clear\"></div>
\t\t<div class=\"nivfooter\">
\t\t\t<p>
                            : les annonces immobilières de particulier à particulier. pap.fr est le premier site immobilier français à proposer des annonces de location et de vente immobilières entre particuliers. Vous trouverez sur PAP de nombreuses annonces : des locations d'appartements, des locations de maisons, des locations de lofts, des maisons à vendre, des annonces de ventes d'appartement. Ces annonces immobilières sont mises à jour régulièrement afin de vous apporter un service optimum.
                           <br>&nbsp;<br>
                           Nous vous invitons également à consulter régulièrement nos rubriques Argent (crédit immobilier, impôts, ...) Conseils immobilier et Travaux Déco.
                           <br>&nbsp;<br>
                           Mentions légales - Protection des données personnelles - Tous droits réservés © De Particulier à Particulier - Réseau immobilier - 1996-2015
                           L'extraction et l'utilisation à des fins professionnelles ou commerciales de tout ou partie de la présente base de données sont interdites.
\t\t\t</p>
\t\t</div>
        </footer>
    </body>
</html>
";
        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

    }

    // line 6
    public function block_title($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Zandoo";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 7
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 79
    public function block_body($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        echo " ";
        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    // line 80
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e = $this->env->getExtension("Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension");
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->enter($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02 = $this->env->getExtension("Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension");
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->enter($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02->leave($__internal_319393461309892924ff6e74d6d6e64287df64b63545b994e100d4ab223aed02_prof);

        
        $__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e->leave($__internal_085b0142806202599c7fe3b329164a92397d8978207a37e79d70b8c52599e33e_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  262 => 80,  244 => 79,  227 => 7,  209 => 6,  161 => 81,  158 => 80,  156 => 79,  122 => 47,  118 => 45,  112 => 42,  108 => 41,  103 => 40,  101 => 39,  75 => 16,  71 => 15,  67 => 14,  63 => 13,  59 => 12,  55 => 11,  51 => 10,  47 => 9,  42 => 8,  40 => 7,  36 => 6,  29 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <title>{% block title %}Zandoo{% endblock %}</title>
        {% block stylesheets %}{% endblock %}
        <link rel=\"icon\" type=\"image/x-icon\" href=\"{{ asset('favicon.ico') }}\" />\t
        <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('public/css/bootstrap.min.css') }}\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('public/css/bootstrap.css') }}\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('public/css/jquery-ui.css') }}\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"{{ asset('public/css/commun.css') }}\">
        <script src=\"{{ asset('public/js/jquery-1.10.2.js')}}\"></script>
        <script src=\"{{ asset('public/js/jquery-ui.js')}}\"></script>
        <script src=\"{{ asset('public/js/bootstrap.js') }}\"></script>
        <script src=\"{{ asset('public/js/bootstrap.min.js') }}\"></script>
\t\t<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>
    <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>
    </head>
    <body>
\t    <!--******************************* En tête principale ************************************-->
        <div class=\"head\">
\t\t\t<div class=\"nivhead\" >
\t\t\t\t<div style=\"border:0px solid #80BFFF;padding:20px 0 0 0;\">
\t\t\t\t\t<div style=\"float:right;border: 0px solid green;width:410px;height:50px;\">
\t\t\t\t\t\t<div style=\"float:left;border-right:1px solid #ccc;height:100%;width:165px;padding:5px 0 0 0;\">
\t\t\t\t\t\t\t<div style=\"float:left;padding:8px 0px 0 0;width:50px;border:0px solid #000;text-align:center;\">
\t\t\t\t\t\t\t\t<span class=\"glyphicon glyphicon-user\" ></span>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\" style=\"font-size:25px;color:#28C4E0;\"></span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div style=\"float:left;width:110px;border:0px solid #000;\">
\t\t\t\t\t\t\t\t<div style=\"margin:2px 0 0px 0;font-size:14px;color:#28C4E0;\">
\t\t\t\t\t\t\t\t\t\t  MON ESPACE
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div style=\"margin:0 0 0px 0;font-size:12px;\">
\t\t\t\t\t\t\t\t{% if is_granted(\"IS_AUTHENTICATED_REMEMBERED\") %}
\t\t\t\t\t\t\t\tBienvenu {{ app.user.username  }}
\t\t\t\t\t\t\t\t<a href=\"{{ path('fos_user_security_logout') }}\">
\t\t\t\t\t\t\t\t\t{{ 'layout.logout'|trans({}, 'FOSUserBundle') }}
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t{% else %}
\t\t\t\t\t\t\t\t\t<a href=\"#\"> Connectez-vous </a>
\t\t\t\t\t\t\t\t{% endif %}
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div style=\"float:left;width:245px;padding:5px 0 0 10px;\">
\t\t\t\t\t\t\t<div style=\"float:left;padding:8px 0px 0 0;width:50px;border:0px solid #000;text-align:center;\">
\t\t\t\t\t\t\t\t<span class=\"glyphicon glyphicon-earphone\" aria-hidden=\"true\" style=\"font-size:25px;color:#28C4E0;\"></span>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div style=\"float:left;width:175px;border:0px solid #000;\">
\t\t\t\t\t\t\t\t<div style=\"margin:2px 0 0px 0;font-size:14px;color:#28C4E0;\"><b>Contactez Nous</b></div>
\t\t\t\t\t\t\t\t<div style=\"margin:0 0 0px 0;font-size:12px;\">du lundi au samedi de 9h à 18h</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t</div>
\t\t\t</div>
\t    </div>
\t\t<!--******************************* Menu principale ************************************-->
        <nav class=\"navbar navbar-expand-lg navbar-light \">
            <a class=\"navbar-brand\" href=\"#\"><strong>Zandoo</strong></a>
            <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarNavAltMarkup\" aria-controls=\"navbarNavAltMarkup\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
              <span class=\"navbar-toggler-icon\"></span>
            </button>
            <div class=\"collapse navbar-collapse\" id=\"navbarNavAltMarkup\">
              <div class=\"navbar-nav\">
                <a class=\"nav-item nav-link active\" href=\"#\"> <span class=\"sr-only\">(current)</span></a>
                <a class=\"nav-item nav-link\" href=\"#\">ARTICLES</a>
                <a class=\"nav-item nav-link\" href=\"#\">BOUTIQUES</a>
                <a class=\"nav-item nav-link put-annonce\" href=\"#\"><strong>DEPOSER UNE ANNONCE</strong></a>
              </div>
            </div>  
        </nav>
        {% block body %} {% endblock %}
        {% block javascripts %}{% endblock %}
        <footer>
            <div class=\"nivfooter\">
\t\t\t<div class=\"nivfootermin\">
\t\t\t\t<a href=\"#\" > Plan du site </a>
\t\t\t</div>
\t\t\t<div class=\"nivfootermax\">
\t\t\t\t<a href=\"#\" > Qui sommes-nous ? </a>
\t\t\t</div>
\t\t\t<div class=\"nivfootermax\">
\t\t\t\t<a href=\"#\" > Nos équipes & Recrutement </a>
\t\t\t</div>
\t\t\t<div class=\"nivfootermax\">
\t\t\t\t<a href=\"#\" >Témoignages clients </a>
\t\t\t</div>
\t\t\t<div class=\"nivfootermin\">
\t\t\t\t<a href=\"#\" > Nous contacter </a>
\t\t\t</div>
\t\t\t<div class=\"nivfootermin\">
\t\t\t\t<a href=\"#\" > CGV </a>
\t\t\t</div>
\t\t\t<div class=\"nivfootermin\">
\t\t\t\t<a href=\"#\"> Affiliation </a>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"clear\"></div>
\t\t<div class=\"nivfooter\">
\t\t\t<p>
                            : les annonces immobilières de particulier à particulier. pap.fr est le premier site immobilier français à proposer des annonces de location et de vente immobilières entre particuliers. Vous trouverez sur PAP de nombreuses annonces : des locations d'appartements, des locations de maisons, des locations de lofts, des maisons à vendre, des annonces de ventes d'appartement. Ces annonces immobilières sont mises à jour régulièrement afin de vous apporter un service optimum.
                           <br>&nbsp;<br>
                           Nous vous invitons également à consulter régulièrement nos rubriques Argent (crédit immobilier, impôts, ...) Conseils immobilier et Travaux Déco.
                           <br>&nbsp;<br>
                           Mentions légales - Protection des données personnelles - Tous droits réservés © De Particulier à Particulier - Réseau immobilier - 1996-2015
                           L'extraction et l'utilisation à des fins professionnelles ou commerciales de tout ou partie de la présente base de données sont interdites.
\t\t\t</p>
\t\t</div>
        </footer>
    </body>
</html>
", "base.html.twig", "C:\\xampp\\htdocs\\zando\\app\\Resources\\views\\base.html.twig");
    }
}
