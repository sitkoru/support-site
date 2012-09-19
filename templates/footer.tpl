
		<footer>
			<p>&copy; {$settings.copyright}, 2012{if $smarty.now|date_format:'%Y' > 2012} - {$smarty.now|date_format:'%Y'}{/if}.</p>
		</footer>

    </div><!--/.fluid-container-->

	{include file="`$paths.admin_templates`/cnct.tpl"}
</body>
</html>