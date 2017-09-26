<?php

/* test/gettext/plural_notes_twig.twig */
class __TwigTemplate_0724f443feb86a0698cc0c906baea9391ed8816701db4e3bdfd3ad319078b026 extends Twig_Template
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
        // notes: Number of tables
        echo strtr(_ngettext("One table", "%count% tables", abs(        // line 3
($context["table_count"] ?? null))), array("%count%" => abs(($context["table_count"] ?? null)), ));
    }

    public function getTemplateName()
    {
        return "test/gettext/plural_notes_twig.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  21 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "test/gettext/plural_notes_twig.twig", "/home/files/phpmyadmin/release/phpMyAdmin-4.8+snapshot/templates/test/gettext/plural_notes_twig.twig");
    }
}
