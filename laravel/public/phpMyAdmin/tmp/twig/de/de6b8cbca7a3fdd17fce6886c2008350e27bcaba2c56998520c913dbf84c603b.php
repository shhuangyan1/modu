<?php

/* test/gettext/gettext_twig.twig */
class __TwigTemplate_62b039447d0051a742057956dff6347b100c8c87125b641601ea86165eb4e896 extends Twig_Template
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
        echo _gettext("Text");
    }

    public function getTemplateName()
    {
        return "test/gettext/gettext_twig.twig";
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
        return new Twig_Source("", "test/gettext/gettext_twig.twig", "/home/files/phpmyadmin/release/phpMyAdmin-4.8+snapshot/templates/test/gettext/gettext_twig.twig");
    }
}
