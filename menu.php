<div class="menu" >

<div>
<div id="centr">
<ul id="menu">
		       
			   				<li>
               <a id="last">Архиерей</a>
			     <ul>  

							<li <? if ($arhi == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($arhi == yes) echo '<a>Биография</a>';
			   				else echo '<a href="arhierei.php">Биография</a>';
							?>
							</li>  

							<li <? if ($slovo_padre == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($slovo_padre == yes) echo '<a>Слово архипастыря</a>';
			   				else echo '<a href="slovo_padre.php">Слово архипастыря</a>';
							?>
							</li>  
							
							<li <? if ($raspisanie == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($raspisanie == yes) echo '<a>Служение</a>';
			   				else echo '<a href="raspisanie.php">Служение</a>';
							?>
							</li>  
                 
                </ul>
        </li>

				<li>
               <a>Новости</a>
			     <ul>  

							<li <? if ($new == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($new == yes) echo '<a>Новости епархии</a>';
			   				else echo '<a href="news.php">Новости епархии</a>';
							?>
							</li>  

							<li <? if ($anons == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($anons == yes) echo '<a>Анонсы и объявления</a>';
			   				else echo '<a href="anons.php">Анонсы и объявления</a>';
							?>
							</li>  
							
							<li <? if ($pub == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($pub == yes) echo '<a>Публикации</a>';
			   				else echo '<a href="pub.php">Публикации</a>';
							?>
							</li>  
							                      
                </ul>
        </li>
				<li>
               <a>Документы</a>
			     <ul>  

							<li <? if ($tip==ukaz) echo 'class="menu_none"';?>>
               				<?
			   				if ($tip==ukaz) echo '<a>Указы</a>';
			   				else echo '<a href="doks.php?tip=ukaz">Указы</a>';
							?>
							</li>  

							<li <? if ($tip == raspor) echo 'class="menu_none"';?>>
               				<?
			   				if ($tip == raspor) echo '<a>Распоряжения</a>';
			   				else echo '<a href="doks.php?tip=raspor">Распоряжения</a>';
							?>
							</li>  
							        
							<li <? if ($tip == cirk) echo 'class="menu_none"';?>>
               				<?
			   				if ($tip == cirk) echo '<a>Циркуляры</a>';
			   				else echo '<a href="doks.php?tip=cirk">Циркуляры</a>';
							?>
							</li>  
									
							<li <? if ($tip == udostoverenie) echo 'class="menu_none"';?>>
               				<?
			   				if ($tip == udostoverenie) echo '<a>Удостоверения</a>';
			   				else echo '<a href="doks.php?tip=udostoverenie">Удостоверения</a>';
							?>
							</li>       
                </ul>
        </li>

		<li>
               <a>Епархия</a>
			     <ul>  

							<li <? if ($histor == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($histor == yes) echo '<a>История</a>';
			   				else echo '<a href="histor.php">История</a>';
							?>
							</li>  

							<li <? if ($upravlenie == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($upravlenie == yes) echo '<a>Управление</a>';
			   				else echo '<a href="upravlenie.php">Управление</a>';
							?>
							</li>  
							                      
							<li <? if ($otdel == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($otdel == yes) echo '<a>Отделы</a>';
			   				else echo '<a href="otdel.php">Отделы</a>';
							?>
							</li>       
                							
							<li <? if ($klir == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($klir == yes) echo '<a>Духовенство</a>';
			   				else echo '<a href="klir.php">Духовенство</a>';
							?>
							</li>       
</ul>
        </li>

				<li>
               <a>Приходы</a>
			     <ul>  

							<li <? if ($mon == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($mon == yes) echo '<a>Жадовский монастырь</a>';
			   				else echo '<a href="mon.php">Жадовский монастырь</a>';
							?>
							</li>  

							<li <? if ($prihods == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($prihods == yes) echo '<a>Действующие приходы</a>';
			   				else echo '<a href="prihods.php">Действующие приходы</a>';
							?>
							</li>  
							                      
							<li <? if ($old_prihods == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($old_prihods == yes) echo '<a>Разрушенные храмы</a>';
			   				else echo '<a href="old_prihods.php">Разрушенные храмы</a>';
							?>
							</li>     
							<li <? if ($map == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($map == yes) echo '<a>Карта приходов</a>';
			   				else echo '<a href="map.php">Карта приходов</a>';
							?>
							</li>     
							
                </ul>
        </li>
				
		<li>
               <a>Медиа</a>
			     <ul>  

				<li <? if ($video == yes) echo 'class="menu_none"';?>>
               <?
			   if ($video == yes) echo '<a>Видео</a>';
			   else echo '<a href="video.php">Видео</a>';
				?>
				
        </li>
				<li <? if ($gazeta == yes) echo 'class="menu_none"';?>>
               <?
			   if ($gazeta == yes) echo '<a>Газета "Моя епархия"</a>';
			   else echo '<a href="gazeta.php">Газета "Моя епархия"</a>';
				?>
				
        </li>

							<li <? if ($radio == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($radio == yes) echo '<a>Радиопередача "Светлый вечер"</a>';
			   				else echo '<a href="sv_vecher.php">Радиопередача "Светлый вечер"</a>';
							?>
							</li>  
							                      
                </ul>
        </li>

        <li <? if ($kontakt == yes) echo 'class="menu_none"';?>>
               <?
			   if ($kontakt == yes) echo '<a>Контакты</a>';
			   else echo '<a href="kontakt.php">Контакты</a>';
				?>
				
        </li> 
		
		<li <? if ($top == yes) echo 'class="menu_none"';?>>
               <?
			   if ($top == yes) echo '<a style="color:red; opacity:.7">Читаемое</a>';
			   else echo '<a class="top" href="top.php">Читаемое</a>';
				?>
				
        </li>

</ul>
</div>
</div>
</div>















<div  id="slidebox">
<div class="menu"  style="border:none" >

<div>
<div id="centr">
<ul id="menu">
		       
			   				<li>
               <a id="last">Архиерей</a>
			     <ul>  

							<li <? if ($arhi == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($arhi == yes) echo '<a>Биография</a>';
			   				else echo '<a href="arhierei.php">Биография</a>';
							?>
							</li>  

							<li <? if ($slovo_padre == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($slovo_padre == yes) echo '<a>Слово архипастыря</a>';
			   				else echo '<a href="slovo_padre.php">Слово архипастыря</a>';
							?>
							</li>  
							
							<li <? if ($raspisanie == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($raspisanie == yes) echo '<a>Служение</a>';
			   				else echo '<a href="raspisanie.php">Служение</a>';
							?>
							</li>  
                 
                </ul>
        </li>

				<li>
               <a>Новости</a>
			     <ul>  

							<li <? if ($new == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($new == yes) echo '<a>Новости епархии</a>';
			   				else echo '<a href="news.php">Новости епархии</a>';
							?>
							</li>  

							<li <? if ($anons == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($anons == yes) echo '<a>Анонсы и объявления</a>';
			   				else echo '<a href="anons.php">Анонсы и объявления</a>';
							?>
							</li>  
							
														<li <? if ($pub == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($pub == yes) echo '<a>Публикации</a>';
			   				else echo '<a href="pub.php">Публикации</a>';
							?>
							</li>  

							                      
                </ul>
        </li>
				<li>
               <a>Документы</a>
			     <ul>  

							<li <? if ($tip==ukaz) echo 'class="menu_none"';?>>
               				<?
			   				if ($tip==ukaz) echo '<a>Указы</a>';
			   				else echo '<a href="doks.php?tip=ukaz">Указы</a>';
							?>
							</li>  

							<li <? if ($tip == raspor) echo 'class="menu_none"';?>>
               				<?
			   				if ($tip == raspor) echo '<a>Распоряжения</a>';
			   				else echo '<a href="doks.php?tip=raspor">Распоряжения</a>';
							?>
							</li>  
							        
							<li <? if ($tip == cirk) echo 'class="menu_none"';?>>
               				<?
			   				if ($tip == cirk) echo '<a>Циркуляры</a>';
			   				else echo '<a href="doks.php?tip=cirk">Циркуляры</a>';
							?>
							</li>  
									
							<li <? if ($tip == udostoverenie) echo 'class="menu_none"';?>>
               				<?
			   				if ($tip == udostoverenie) echo '<a>Удостоверения</a>';
			   				else echo '<a href="doks.php?tip=udostoverenie">Удостоверения</a>';
							?>
							</li>       
                </ul>
        </li>

		<li>
               <a>Епархия</a>
			     <ul>  

							<li <? if ($histor == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($histor == yes) echo '<a>История</a>';
			   				else echo '<a href="histor.php">История</a>';
							?>
							</li>  

							<li <? if ($upravlenie == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($upravlenie == yes) echo '<a>Управление</a>';
			   				else echo '<a href="upravlenie.php">Управление</a>';
							?>
							</li>  
							                      
							<li <? if ($otdel == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($otdel == yes) echo '<a>Отделы</a>';
			   				else echo '<a href="otdel.php">Отделы</a>';
							?>
							</li>       
							
							<li <? if ($klir == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($klir == yes) echo '<a>Духовенство</a>';
			   				else echo '<a href="klir.php">Духовенство</a>';
							?>
							</li>       
                </ul>
        </li>

				<li>
               <a>Приходы</a>
			     <ul>  

							<li <? if ($mon == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($mon == yes) echo '<a>Жадовский монастырь</a>';
			   				else echo '<a href="mon.php">Жадовский монастырь</a>';
							?>
							</li>  

							<li <? if ($prihods == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($prihods == yes) echo '<a>Действующие приходы</a>';
			   				else echo '<a href="prihods.php">Действующие приходы</a>';
							?>
							</li>  
							                      
							<li <? if ($old_prihods == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($old_prihods == yes) echo '<a>Разрушенные храмы</a>';
			   				else echo '<a href="old_prihods.php">Разрушенные храмы</a>';
							?>
							</li>     
							<li <? if ($map == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($map == yes) echo '<a>Карта приходов</a>';
			   				else echo '<a href="map.php">Карта приходов</a>';
							?>
							</li>     

                </ul>
        </li>
				
		<li>
               <a>Медиа</a>
			     <ul>  

				<li <? if ($video == yes) echo 'class="menu_none"';?>>
               <?
			   if ($video == yes) echo '<a>Видео</a>';
			   else echo '<a href="video.php">Видео</a>';
				?>
				
        </li>
				<li <? if ($gazeta == yes) echo 'class="menu_none"';?>>
               <?
			   if ($gazeta == yes) echo '<a>Газета "Моя епархия"</a>';
			   else echo '<a href="gazeta.php">Газета "Моя епархия"</a>';
				?>
				
        </li>

							<li <? if ($radio == yes) echo 'class="menu_none"';?>>
               				<?
			   				if ($radio == yes) echo '<a>Радиопередача "Светлый вечер"</a>';
			   				else echo '<a href="sv_vecher.php">Радиопередача "Светлый вечер"</a>';
							?>
							</li>  
							                      
                </ul>
        </li>

        <li <? if ($kontakt == yes) echo 'class="menu_none"';?>>
               <?
			   if ($kontakt == yes) echo '<a>Контакты</a>';
			   else echo '<a href="kontakt.php">Контакты</a>';
				?>
				
        </li>
		<li <? if ($top == yes) echo 'class="menu_none"';?>>
               <?
			   if ($top == yes) echo '<a style="color:red; opacity:.7">Читаемое</a>';
			   else echo '<a class="top" href="top.php">Читаемое</a>';
				?>
				
        </li>

</ul>
</div>
</div>
</div>
</div>
