/**
 * ES6 Modern Format (Moodle 4.x/5.0+)
 */
import Ajax from 'core/ajax';
import Notification from 'core/notification';

export const init = () => {
    const selects = document.querySelectorAll('.yetkinlik-select');
    selects.forEach(select => {
        select.addEventListener('change', async (e) => {
            const target = e.target;
            try {
                await Ajax.call([{
                    methodname: 'qbank_yetkinlik_save_question_competency',
                    args: {
                        questionid: target.dataset.questionid,
                        competencyid: target.value,
                        courseid: target.dataset.courseid
                    }
                }])[0];
                // Başarılı!
            } catch (error) {
                Notification.exception(error);
            }
        });
    });
};