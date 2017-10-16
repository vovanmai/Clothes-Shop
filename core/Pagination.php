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
        'link_full'     => '',// Link full có dạng như sau: domain/com/page/{page}
        'link_first'    => '',// Link trang đầu tiên
        'range'         => 6, // Số button trang bạn muốn hiển thị 
        'min'           => 0, // Tham số min
        'max'           => 0  // tham số max, min và max là 2 tham số private
        );
    
    public static function pagination($count,$link_full)
    {
        $config = array(
            'current_page'  => isset($_GET['p']) ? $_GET['p'] : 1, // Trang hiện tại
            'total_record'  => $count, // Tổng số record
            //  'limit'         => 10,// limit
            'link_full'     => $link_full, //'/admin/users?p={page}' =Link full có dạng như sau: domain/com/page/{page}
            'link_first'    => str_replace('{page}', '1', $link_full),// Link trang đầu tiên
            'range'         => 9, // Số button trang bạn muốn hiển thị 
            );
        $paging = new Pagination();
        $paging->init($config);
        $paginghtml = $paging->html();
        return  array('config' => $paging->_config, 'paginghtml' => $paginghtml, );
    }
    function init($config = array())
    {
        foreach ($config as $key => $val){
            if (isset($this->_config[$key])){
                $this->_config[$key] = $val;
            }
        }
        
        
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
        if ($page <= 1 && $this->_config['link_first']){
            return $this->_config['link_first'];
        }
        return str_replace('{page}', $page, $this->_config['link_full']);
    }
    
    
    public function html()
    {   
        $p = '';
        if ($this->_config['total_record'] > $this->_config['limit'])
        {
            $p = '<ul class="pagination">';

            if ($this->_config['current_page'] > 1)
            {
                $p .= '<li><a href="'.$this->__link('1').'">First</a></li>';
                $p .= '<li><a href="'.$this->__link($this->_config['current_page']-1).'">Prev</a></li>';
            }
            
            for ($i = $this->_config['min']; $i <= $this->_config['max']; $i++)
            {
                if ($this->_config['current_page'] == $i){
                    $p .= '<li><span>'.$i.'</span></li>';
                }
                else{
                    $p .= '<li><a href="'.$this->__link($i).'">'.$i.'</a></li>';
                }
            }
            
            if ($this->_config['current_page'] < $this->_config['total_page'])
            {
                $p .= '<li><a href="'.$this->__link($this->_config['current_page'] + 1).'">Next</a></li>';
                $p .= '<li><a href="'.$this->__link($this->_config['total_page']).'">Last</a></li>';
            }
            
            $p .= '</ul>';
        }
        return $p;
    }
}
?>