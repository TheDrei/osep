<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProposalsComment extends Model
{
	protected $fillable = [
        'proposal_idproposal',
        'idcomment_type',
        'users_id',
        'version_id',
        'comment_section_id',
        'proposal_field_id',
        'proposal_field_class',
        'uniqueName',
        'proposal_field',
        'comment_section',
        'comment_order',
        'comment_text',
        'comments',
        'style',
        'is_inline'
	];

	protected $table = 'proposal_comments';
}
