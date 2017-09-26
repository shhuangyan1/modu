<?php

/* test/echo_twig.twig */
class __TwigTemplate_0e0dbd2db606a50b5888c89f15d4eacf85e8d111ee4e1d1e4295d14afe0225f7 extends Twig_Template
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
        echo twig_escape_filter($this->env, ($context["variable"] ?? null), "html", null, true);
    }

    public function getTemplateName()
    {
        return "test/echo_twig.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "test/echo_twig.twig", "/home/files/phpmyadmin/release/phpMyAdmin-4.8+snapshot/templates/test/echo_twig.twig");
    }
}
