tinyMCEPopup.requireLangPack();

var LinkDialog = {
	preInit : function() {
		var url;

		if (url = tinyMCEPopup.getParam("external_link_list_url"))
			document.write('<script language="javascript" type="text/javascript" src="' + tinyMCEPopup.editor.documentBaseURI.toAbsolute(url) + '"></script>');
	},

	init : function() {
		var f = document.forms[0], ed = tinyMCEPopup.editor;

		// Setup browse button
		document.getElementById('hrefbrowsercontainer').innerHTML = getBrowserHTML('hrefbrowser', 'href', 'file', 'theme_advanced_link');
		if (isVisible('hrefbrowser'))
			document.getElementById('href').style.width = '180px';

//		this.fillClassList('class_list');
//		this.fillFileList('link_list', 'tinyMCELinkList');
//		this.fillTargetList('target_list');
//
		if (e = ed.dom.getParent(ed.selection.getNode(), 'A')) {
			f.linktitle.value = ed.dom.getAttrib(e, 'title');
//
		}
	},
        	update : function() {
                
		var f = document.forms[0];
                ed = tinyMCEPopup.editor;
//                e, b, href = f.href.value.replace(/ /g, '%20');

		tinyMCEPopup.restoreSelection();
		e = ed.dom.getParent(ed.selection.getNode(), 'A');

		// Remove element if there is no href
		if (!f.linktitle.value) {
                    
			if (e) {
                            
                          alert('3');
				b = ed.selection.getBookmark();
				ed.dom.remove(e, 1);
				ed.selection.moveToBookmark(b);
				tinyMCEPopup.execCommand("mceEndUndoLevel");
				tinyMCEPopup.close();
				return;
			}
		}


		// Create new anchor elements
			ed.getDoc().execCommand("unlink", false, null);
			tinyMCEPopup.execCommand("myInsertTooltip", false, f.linktitle.value, {skip_undo : 1});

			tinymce.each(ed.dom.select("a"), function(n) {
				if (ed.dom.getAttrib(n, 'title') == '#') {
					e = n;

					ed.dom.setAttribs(e, {
						href : '#',
						rel : 'tooltip',
						title : f.linktitle.value
					});
				}
			});
		


		tinyMCEPopup.execCommand("mceEndUndoLevel");
		tinyMCEPopup.close();
	}
       

};

LinkDialog.preInit();
tinyMCEPopup.onInit.add(LinkDialog.init, LinkDialog);
