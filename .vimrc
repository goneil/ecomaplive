syntax on
set number
set tw=80
set autoindent
set tabstop=4       " The width of a TAB is set to 4.
                    " Still it is a \t. It is just that
                                " Vim will interpret it to be having
                                        " a width of 4.
set shiftwidth=4    " Indents will have a width of 4

set softtabstop=4   " Sets the number of columns for a TAB

set expandtab       " Expand TABs to spaces
set pastetoggle=<F2>
set ruler
autocmd Filetype jsim let tlist_jsim_settings = 'jsim;s:Subcircuits;p:Plots;x:Instantiations' | TlistOpen | wincmd l

"Use TAB to complete when typing words, else inserts TABs as usual.
"Uses dictionary and source files to find matching words to complete.

"See help completion for source,
"Note: usual completion is on <C-n> but more trouble to press all the time.
"Never type the same word twice and maybe learn a new spellings!
"Use the Linux dictionary when spelling is in doubt.
"Window users can copy the file to their machine.
function! Tab_Or_Complete()
  if col('.')>1 && strpart( getline('.'), col('.')-2, 3 ) =~ '^\w'
    return "\<C-N>"
  else
    return "\<Tab>"
  endif
endfunction
:inoremap <Tab> <C-R>=Tab_Or_Complete()<CR>
:set dictionary="/usr/dict/words
