<?xml version="1.0"?>
<OpenSearchDescription 
	xmlns="http://a9.com/-/spec/opensearch/1.1/" 
	xmlns:moz="http://www.mozilla.org/2006/browser/search/">
	
	<ShortName>Поиск (ru)</ShortName>
	<Description>Поиск (ru)</Description>
	<Image height="16" width="16" type="image/x-icon">http://help.sitko.ru/favicon.ico</Image>
	<Url type="text/html" method="get" template="http://help.sitko.ru/search.html?search={searchTerms}" />
	<Url type="application/x-suggestions+json" method="get" template="http://help.sitko.ru/search.html?search={searchTerms}&amp;namespace=0" />
	<Url type="application/x-suggestions+xml" method="get" template="http://help.sitko.ru/search.html?format=xml&amp;search={searchTerms}&amp;namespace=0" />
	<moz:SearchForm>http://help.sitko.ru/search.html</moz:SearchForm>
</OpenSearchDescription>