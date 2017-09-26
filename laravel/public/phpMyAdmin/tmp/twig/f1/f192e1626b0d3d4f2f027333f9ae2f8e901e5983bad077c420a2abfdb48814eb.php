<?php

/* test/add_data_twig.twig */
class __TwigTemplate_f423d8309ff8cba267d3877776ce9519d536620dad7ba06663df0cedc949c67f extends Twig_Template
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
        echo twig_escape_filter($this->env, ($context["variable1"] ?? null), "html", null, true);
        echo "
";
        // line 2
        echo twig_escape_filter($this->env, ($context["variable2"] ?? null), "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "test/add_data_twig.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  23 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "test/add_data_twig.twig", "/home/files/phpmyadmin/release/phpMyAdmin-4.8+snapshot/templates/test/add_data_twig.twig");
    }
}
