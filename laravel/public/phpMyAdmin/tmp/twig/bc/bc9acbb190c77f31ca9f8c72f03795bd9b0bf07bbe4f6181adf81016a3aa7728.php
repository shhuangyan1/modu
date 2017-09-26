<?php

/* prefs_autoload.twig */
class __TwigTemplate_cc2979f2bc8e62ba738bb06c9898926967b912e1a1bdef99b5c044b638c96109 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div id=\"prefs_autoload\" class=\"notice print_ignore hide\">
    <form action=\"prefs_manage.php\" method=\"post\" class=\"disableAjax\">
        ";
        // line 3
        echo ($context["hidden_inputs"] ?? null);
        echo "
        <input type=\"hidden\" name=\"json\" value=\"\" />
        <input type=\"hidden\" name=\"submit_import\" value=\"1\" />
        <input type=\"hidden\" name=\"return_url\" value=\"";
        // line 6
        echo twig_escape_filter($this->env, ($context["return_url"] ?? null), "html", null, true);
        echo "\" />
        ";
        // line 7
        echo _gettext("Your browser has phpMyAdmin configuration for this domain. Would you like to import it for current session?");
        // line 10
        echo "        <br />
        <a href=\"#yes\">";
        // line 11
        echo _gettext("Yes");
        echo "</a>
        / <a href=\"#no\">";
        // line 12
        echo _gettext("No");
        echo "</a>
        / <a href=\"#delete\">";
        // line 13
        echo _gettext("Delete settings");
        echo "</a>
    </form>
</div>
";
    }

    public function getTemplateName()
    {
        return "prefs_autoload.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 13,  42 => 12,  38 => 11,  35 => 10,  33 => 7,  29 => 6,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "prefs_autoload.twig", "/home/files/phpmyadmin/release/phpMyAdmin-4.8+snapshot/templates/prefs_autoload.twig");
    }
}
