<?php

/* main.html.twig */
class __TwigTemplate_c72ff053a001b3ff7be9680f31a83d4478e13613d1b5b7aad56bb3bff428940d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'master_header' => array($this, 'block_master_header'),
            'page_content' => array($this, 'block_page_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Bank Transfers</title>
    <link href=\"https://fonts.googleapis.com/css?family=Roboto:300,400,500,700\" rel=\"stylesheet\">
    <link href=\"static/styles/main.css\" rel=\"stylesheet\">
    <script src=\"static/scripts/main.js\"></script>
</head>
<body>
<header class=\"header\">
    <div class=\"content\">
        <div class=\"logo\">
            <a href=\"/index.html\" class=\"icon\" title=\"Go to home page\">logo</a>
        </div>
        <div class=\"menu\">
            <nav>
                <ul>
                    <li><a href=\"/about.html\">About</a></li>
                    <li><a href=\"/banks.html\">Bank Transfers</a></li>
                    <li><a href=\"/fundraising.html\">Fundraising</a></li>
                    <li><a href=\"/paypal.html\">PayPal</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<div class=\"master-header\">
    ";
        // line 30
        $this->displayBlock('master_header', $context, $blocks);
        // line 32
        echo "</div>

<section class=\"page-content\">
    ";
        // line 35
        $this->displayBlock('page_content', $context, $blocks);
        // line 37
        echo "</section>
</body>
</html>
";
    }

    // line 30
    public function block_master_header($context, array $blocks = array())
    {
        // line 31
        echo "    ";
    }

    // line 35
    public function block_page_content($context, array $blocks = array())
    {
        // line 36
        echo "    ";
    }

    public function getTemplateName()
    {
        return "main.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  78 => 36,  75 => 35,  71 => 31,  68 => 30,  61 => 37,  59 => 35,  54 => 32,  52 => 30,  21 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "main.html.twig", "/var/www/html/layouts/main.html.twig");
    }
}
