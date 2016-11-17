<?php

/* banks.html.twig */
class __TwigTemplate_640815ae484b58fd4177d0d7e0ac3dd3e2979cfa0ff2f7e83962fe77d493af9b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("main.html.twig", "banks.html.twig", 1);
        $this->blocks = array(
            'master_header' => array($this, 'block_master_header'),
            'page_content' => array($this, 'block_page_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "main.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["pageTitle"] = "Banks";
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_master_header($context, array $blocks = array())
    {
        // line 5
        echo "    <h1>Banks page</h1>
";
    }

    // line 8
    public function block_page_content($context, array $blocks = array())
    {
        // line 9
        echo "    <p>
        Bank info
    </p>
";
    }

    public function getTemplateName()
    {
        return "banks.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 9,  40 => 8,  35 => 5,  32 => 4,  28 => 1,  26 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "banks.html.twig", "/var/www/html/pages/en/banks.html.twig");
    }
}
