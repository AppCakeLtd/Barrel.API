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
 */ ?>
<div class="alert alert-error">
	<h2><?php echo __d('cake_dev', 'Database Error'); ?></h2>
	<p class="error">
		<strong><?php echo __d('cake_dev', 'Error'); ?>: </strong>
		<?php echo $name; ?>
	</p>
	<?php if (!empty($error->queryString)) : ?>
		<p class="notice">
			<strong><?php echo __d('cake_dev', 'SQL Query'); ?>: </strong>
			<?php echo h($error->queryString); ?>
		</p>
	<?php endif; ?>
	<?php if (!empty($error->params)) : ?>
			<strong><?php echo __d('cake_dev', 'SQL Query Params'); ?>: </strong>
			<?php echo Debugger::dump($error->params); ?>
	<?php endif; ?>
	<?php echo $this->element('exception_stack_trace'); ?>
</div>