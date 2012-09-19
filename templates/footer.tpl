
		<footer>
			<p>&copy; 2012{if $smarty.now|date_format:'%Y' > 2012} - {$smarty.now|date_format:'%Y'}{/if}, {$settings.copyright}.</p>
		</footer>

    </div><!--/.fluid-container-->

	{include file="`$paths.admin_templates`/cnct.tpl"}
</body>
</html>