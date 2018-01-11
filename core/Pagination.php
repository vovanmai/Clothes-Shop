<?php  
namespace core;

class Pagination
{
    public $_config = array(
        'current_page'  => 1, // Trang hiện tại
        'total_record'  => 1, // Tổng số record
        'total_page'    => 1, // Tổng số trang
        'limit'         => 10,// limit
        'start'         => 0, // start
        'range'         => 9, // Số button trang bạn muốn hiển thị 
        'min'           => 0, // Tham số min
        'max'           => 0,  // tham số max, min và max là 2 tham số private
        'func'          => '',
        'link'          => ''
        );
    

    function init($func,$link,$current_page, $limit, $total_record)
    {
        $this->_config['current_page'] = $current_page;
        $this->_config['limit'] = $limit;
        $this->_config['link'] = $link;
        $this->_config['total_record'] = $total_record;
        $this->_config['func'] = $func;
        
        if ($this->_config['limit'] < 0){
            $this->_config['limit'] = 0;
        }
        
        $this->_config['total_page'] = ceil($this->_config['total_record'] / $this->_config['limit']);
        
        
        if (!$this->_config['total_page']){
            $this->_config['total_page'] = 1;
        }
        
        
        if ($this->_config['current_page'] < 1){
            $this->_config['current_page'] = 1;
        }
        
        if ($this->_config['current_page'] > $this->_config['total_page']){
            $this->_config['current_page'] = $this->_config['total_page'];
        }
        
        
        $this->_config['start'] = ($this->_config['current_page'] - 1) * $this->_config['limit'];
        
        
        $middle = ceil($this->_config['range'] / 2);
        
        if ($this->_config['total_page'] < $this->_config['range']){
            $this->_config['min'] = 1;
            $this->_config['max'] = $this->_config['total_page'];
        }
        else
        {
            $this->_config['min'] = $this->_config['current_page'] - $middle + 1;
            
            $this->_config['max'] = $this->_config['current_page'] + $middle - 1;
            
            if ($this->_config['min'] < 1){
                $this->_config['min'] = 1;
                $this->_config['max'] = $this->_config['range'];
            }
            
            else if ($this->_config['max'] > $this->_config['total_page']) 
            {
                $this->_config['max'] = $this->_config['total_page'];
                $this->_config['min'] = $this->_config['total_page'] - $this->_config['range'] + 1;
            }
        }
    }
    
    private function __link($page)
    {
        return str_replace('{page}', $page, $this->_config['link']);
    }
    
    public function gethtml() {
        $p = '';
        if ($this->_config['total_record'] > $this->_config['limit'])
        {
            $p = '<ul>';
             
            // Nút prev và first
            if ($this->_config['current_page'] > 1)
            {
                $p .= '<li><a href="'.$this->__link('1').'">First</a></li>';
                $p .= '<li><a href="'.$this->__link($this->_config['current_page']-1).'">Prev</a></li>';
            }
             
            // lặp trong khoảng cách giữa min và max để hiển thị các nút
            for ($i = $this->_config['min']; $i <= $this->_config['max']; $i++)
            {
                // Trang hiện tại
                if ($this->_config['current_page'] == $i){
                    $p .= '<li><span>'.$i.'</span></li>';
                }
                else{
                    $p .= '<li><a href="'.$this->__link($i).'">'.$i.'</a></li>';
                }
            }
 
            // Nút last và next
            if ($this->_config['current_page'] < $this->_config['total_page'])
            {
                $p .= '<li><a href="'.$this->__link($this->_config['current_page'] + 1).'">Next</a></li>';
                $p .= '<li><a href="'.$this->__link($this->_config['total_page']).'">Last</a></li>';
            }
             
            $p .= '</ul>';
        }
        return $p;
    }
    
    public function ajaxhtml()
    {   
        $p = '';
        if ($this->_config['total_record'] > $this->_config['limit'])
        {
            $p = '<ul class="pagination"> ';

            if ($this->_config['current_page'] > 1)
            {
                $p .= '<li><a href="javascript:void(0);" 
                onclick="paging(\''.$this->_config['func'].'\',1)">First</a></li>';
                $p .= '<li><a href="javascript:void(0);" 
                onclick="paging(\''.$this->_config['func'].'\','.($this->_config['current_page'] - 1).')">Prev</a></li>';
            }
            
            for ($i = $this->_config['min']; $i <= $this->_config['max']; $i++)
            {
                if ($this->_config['current_page'] == $i){
                    $p .= '<li><span>'.$i.'</span></li>';
                }
                else{
                    $p .= '<li><a href="javascript:void(0);" 
                    onclick="paging(\''.$this->_config['func'].'\','.$i.')">'.$i.'</a></li>';
                }
            }
            
            if ($this->_config['current_page'] < $this->_config['total_page'])
            {
                $p .= '<li><a href="javascript:void(0);" 
                onclick="paging(\''.$this->_config['func'].'\','.($this->_config['current_page'] + 1).')">Next</a></li>';
                $p .= '<li><a href="javascript:void(0);"
                onclick="paging(\''.$this->_config['func'].'\','.$this->_config['total_page'].')">Last</a></li>';
            }
            
            $p .= '</ul>';
        }
        return $p;
    }
}
?>