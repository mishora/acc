<?php
class Item extends Eloquent
{
    /**
     * @var array
     */
    protected $fillable = array(
        'office',
        'type',
        'cat',
        'partner',
        'name',
        'desc',
        'quantity',
        'price',
        'amount',
        'issue_date',
        'issue_check',
        'pay_date',
        'reason',
        'pay_check',
        'inexact',
        'created_at',
        'updated_at'
    );

    public function mark($type)
    {
        if ($type == 'issue_check') {
            $this->issue_check = $this->issue_check ? false : true;
        }

        if ($type == 'pay_check') {
            $this->pay_check = $this->pay_check ? false : true;
            if ($this->pay_check == true) {
                $this->inexact = false;
            }
        }

        Session::flash ('insertedId', $this->id, 1);

        if (!$this->save()) {
        	return -1;
        }
        return 0;
    }

}