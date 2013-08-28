<?php
/**
 Copyright (c) 2013, Barrel Team
 
 Redistribution and use in source and binary forms, with or without
 modification, are permitted provided that the following conditions are met:
 * Redistributions of source code must retain the above copyright
 notice, this list of conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright
 notice, this list of conditions and the following disclaimer in the
 documentation and/or other materials provided with the distribution.
 * Neither the name of the Barrel Team nor the
 names of its contributors may be used to endorse or promote products
 derived from this software without specific prior written permission.
 
 THIS SOFTWARE IS PROVIDED BY Barrel Team ''AS IS'' AND ANY
 EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 DISCLAIMED. IN NO EVENT SHALL Barrel Team BE LIABLE FOR ANY
 DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */
?>
<div class="btn-toolbar">
	<div class="btn-group btn-group-center">
		<a class="btn active" data-letter="Latest" href="/Games/Database/Latest">Latest</a>
		<?php
			foreach(range('a','z') as $i) {
				echo '<a class="btn btn-narrow" data-letter="' . $i . '" href="/Games/Database/' . $i . '">' . $i . '</a>';
			}
		?>
	</div>
	<div class="btn-group btn-group-center">
		<?php
			for($i=0; $i<10; $i++) {
				echo '<a class="btn btn-narrow" data-letter="' . $i . '" href="/Games/Database/' . $i . '">' . $i . '</a>';
			}
		?>
	</div>
</div>

<!-- Database entries start -->
<?php
foreach($allGames as $game) { ?>
<div class="span12 thumbs clearfix entries">
	<ul class="thumbnails">
		<li class="span12">
			<div class="thumbnail">
				<div class="thumb-holder">
					<img src="<?php echo $game["Game"]["coverArtURL"]; ?>" alt="<?php echo $game["Game"]["name"] . " Cover Art"; ?>" class="img-rounded" />
				</div>
				<h3><?php echo $game["Game"]["name"]; ?></h3>
				<h5><small>ported by <?php echo $game["Users"]["username"]; ?></small></h5>
				<p><?php echo nl2br(h($game["Game"]["description"])); ?></p>
			</div>
		</li>
	</ul>
</div>
<?php
}
?>