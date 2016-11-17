<?php

/* main.html.twig */
class __TwigTemplate_3008b41eadde58e8aa302905d1d7e4dc362444263c1767d916290d29007177d2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.html.twig", "main.html.twig", 1);
        $this->blocks = array(
            'nav_links' => array($this, 'block_nav_links'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_nav_links($context, array $blocks = array())
    {
        // line 4
        echo "    <li><a href=\"/";
        echo twig_escape_filter($this->env, (isset($context["lang"]) ? $context["lang"] : null), "html", null, true);
        echo "/about.html\" class=\"internal\">About</a></li>
    <li><a href=\"/";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["lang"]) ? $context["lang"] : null), "html", null, true);
        echo "/banks.html\" class=\"internal\">Bank Transfers</a></li>
    <li><a href=\"/";
        // line 6
        echo twig_escape_filter($this->env, (isset($context["lang"]) ? $context["lang"] : null), "html", null, true);
        echo "/fundraising.html\" class=\"internal\">Fundraising</a></li>
    <li><a href=\"/";
        // line 7
        echo twig_escape_filter($this->env, (isset($context["lang"]) ? $context["lang"] : null), "html", null, true);
        echo "/paypal.html\" class=\"internal\">PayPal</a></li>
";
    }

    public function getTemplateName()
    {
        return "main.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 7,  40 => 6,  36 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "main.html.twig", "/var/www/html/layouts/en/main.html.twig");
    }
}
