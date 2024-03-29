<?php namespace VanTran\LunarCalendar\Converters;

/**
 * Bộ chuyển đổi nền tảng hỗ trợ tính toán pha Trăng mới (Sóc) tương ứng với thời điểm đầu vào
 * 
 * @author Văn Trần <caovan.info@gmail.com>
 * @package VanTran\LunarCalendar\Converters
 */
class BaseNewMoonPhaseConverter extends AbstractMoonPhaseConverter
{
    /**
     * Ở chế độ nghiêm ngặt, trong trường hợp số ngày Julian đầu vào (A) chính là ngày tương ứng với pha Trăng mới (B), 
     * nhưng nếu (A) nhỏ hơn (B) ở phần số thập phân xác định giờ phút giây, thì (A) sẽ được xác định thuộc về pha Trăng
     * mới trước đó.
     */
    public const STRICT_MODE = 2;

    /**
     * Ở chế độ thông thường, trong trường hợp số ngày Julian đầu vào (A) chính là ngày tương ứng với pha Trăng mới (B), 
     * nhưng nếu (A) nhỏ hơn (B)  ở phần số thập phân xác định giờ phút giây, thì (A) vẫn sẽ được xác định thuộc về pha
     * Trăng mới hiện tại.
     */
    public const NORMAL_MODE = 1;

    public function __construct(float $jd, int $offset = 0, protected int $mode = self::NORMAL_MODE)
    {
        if ($this->mode === self::NORMAL_MODE) {
            $jd += 1;
        }
        else {
            $jd -= 0.000001; // Hiệu chỉnh sai số
        }

        parent::__construct($jd, $offset);
    }

    /**
     * {@inheritdoc}
     */
    protected function registerPhaseSelector(): float 
    { 
        return 0.0;
    }
}