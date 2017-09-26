<?php

/* test/static_twig.twig */
class __TwigTemplate_5a91f5e5e55e9b98c626aba4750f8f745202450ab6f8adae51136de726be833f extends Twig_Template
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
        echo "static content";
    }

    public function getTemplateName()
    {
        return "test/static_twig.twig";
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
        return new Twig_Source("", "test/static_twig.twig", "/home/files/phpmyadmin/release/phpMyAdmin-4.8+snapshot/templates/test/static_twig.twig");
    }
}
